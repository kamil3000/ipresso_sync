<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:15
 */

namespace Ipresso\Repository;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use Ipresso\Domain\Activity;
use Ipresso\Domain\Contact;
use Ipresso\Hydrator\ContactHydrator;
use stdClass;

readonly class ContactRepository implements ContactRepositoryInterface
{
    public function __construct(private Client $client, private ContactHydrator $hydrator)
    {
    }

    public function remove(int $id): bool
    {
        try {
            /** @var  $response Response */
            $response = $this->client->delete('api/2/contact/' . $id);
            return $response->getStatusCode() == 200;
        } catch (\Exception) {
            return false;
        }

    }

    public function getAcivity(Contact $contact)
    {
        $url = 'api/2/contact/' . $contact->getIdContact() . '/activity';
        $response = $this->client->get($url);
        $body = json_decode((string)$response->getBody());
        return $body;
    }

    public function addAcivity(Contact $contact, Activity $activity)
    {
        $body = [];

        $body['activity'][] = $activity->serialize();

        $url = 'api/2/contact/' . $contact->getIdContact() . '/activity';

        /** @var  $response Response */
        $response = $this->client->post($url, [
            'form_params' => $body,
        ]);

        return json_decode((string)$response->getBody());
    }


    public function add(Contact $contact): Contact
    {
        $body['contact'] = [];

        $body['contact'][] = $this->hydrator->extract($contact);

        /** @var  $response Response */
        $response = $this->client->post('api/2/contact', [
            'form_params' => $body,
        ]);


        if ($response->getStatusCode() == 403) {
            /** Wrong token! Please authorize again! */
        }

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());


            if (!($body instanceof stdClass)) {
                throw new Exception('bład parsowania odpowiedzi');
            }

            if (!isset($body->data->contact)) {
                throw new Exception('brak pola contact w odpowiedzi');
            }

            foreach ($body->data->contact as $item) {
                if (!isset($item->id)) {
                    throw new Exception('payload not recognized ' . json_encode($body));
                }

                $contact->setIdContact($item->id);
                if ($item->code == 303) {
                    throw new AlreadyExistsException($contact->getIdContact());
                }
            }
        }
        return $contact;
    }

    public function update(Contact $contact): Contact
    {
        if ($contact->getIdContact() == null) {
            throw new InvalidArgumentException('bark id kontaktu');
        }

        $body['contact'] = $this->hydrator->extract($contact);

        unset($body['contact']['email']);

        /** @var  $response Response */
        $response = $this->client->put('api/2/contact/' . $contact->getIdContact(), [
            'form_params' => $body,
        ]);
        if ($response->getStatusCode() == 201) {
            return $contact;
        }
        throw new Exception('nie można updatować zasobu');
    }

    public function findByEmail($email): array
    {
        $body['contact']['email'] = $email;

        try {
            /** @var  $response Response */
            $response = $this->client->post('api/2/contact/search', [
                'form_params' => $body,
            ]);


            if ($response->getStatusCode() == 200) {
                $responseBody = json_decode((string)$response->getBody());

                return $responseBody->data->contact ?? [];
            }
        } catch (ClientException $exception) {
            if ($exception->getCode() === 404) {
                return [];
            }
        }

        throw new Exception('problem z api' . $response->getStatusCode() . ' ' . (string)$response->getBody());
    }

    public function getById($id)
    {
        /** @var  $response Response */
        $response = $this->client->get('api/2/contact/' . $id);

        $body = json_decode((string)$response->getBody());

        if ($response->getStatusCode() == 200) {
            if (!($body instanceof stdClass)) {
                throw new Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->contact)) {
                throw new Exception('brak pola contact w odpowiedzi');
            }


            return $this->hydrator->hydrate((array)$body->data->contact);
        }

        return null;
    }
}