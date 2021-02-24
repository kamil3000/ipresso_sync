<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:15
 */

namespace Ipresso\Repository;

use GuzzleHttp\Client;
use Ipresso\Domain\Contact;
use Ipresso\Hydrator\ContactHydrator;

class ContactRepository implements ContactRepositoryInterface
{
    /** @var Client */
    private $client;

    /** @var ContactHydrator */
    private $hydrator;

    /**
     * ContactRepository constructor.
     * @param Client $client
     * @param ContactHydrator $hydrator
     */
    public function __construct( Client $client, ContactHydrator $hydrator )
    {
        $this->client = $client;
        $this->hydrator = $hydrator;
    }


    public function add( Contact $contact ): Contact
    {
        $body['contact'] = array();

        $body['contact'][] = $this->hydrator->extract($contact);

        /** @var  $response \GuzzleHttp\Psr7\Response */
        $response = $this->client->post('api/2/contact', array(
            'form_params' => $body
        ));


        if ($response->getStatusCode() == 403) {
            /** Wrong token! Please authorize again! */
        }

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());


            if (!($body instanceof \stdClass)) {
                throw new \Exception('bład parsowania odpowiedzi');
            }

            if (!isset($body->data->contact)) {
                throw new \Exception('brak pola contact w odpowiedzi');
            }



            foreach ($body->data->contact as $item) {

                if(!isset($item->id)){
                    throw new \Exception('brak pola id');
                }

                $contact->setIdContact($item->id);
                if ($item->code == 303) {
                    throw new AlreadyExistsException($contact->getIdContact());
                }
            }


            return $contact;


        }

    }

    public function update( Contact $contact ): Contact
    {
        if ($contact->getIdContact() == null) {
            throw new \InvalidArgumentException('bark id kontaktu');
        }

        $body['contact'] = $this->hydrator->extract($contact);



        /** @var  $response \GuzzleHttp\Psr7\Response */
        $response = $this->client->put('api/2/contact/'.$contact->getIdContact(), array(
            'form_params' => $body
        ));
        if ($response->getStatusCode() == 201) {
                return $contact;
        }
        throw new \Exception('nie można updatować zasobu');
    }

    public function getById( $id )
    {
        /** @var  $response \GuzzleHttp\Psr7\Response */
        $response = $this->client->get('api/2/contact/' . $id);

        $body = json_decode((string)$response->getBody());
        if ($response->getStatusCode() == 200) {
            if (!($body instanceof \stdClass)) {
                throw new \Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->contact)) {
                throw new \Exception('brak pola contact w odpowiedzi');
            }


            return $this->hydrator->hydrate((array)$body->data->contact);
        }
        return null;
    }
}