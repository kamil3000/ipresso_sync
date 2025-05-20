<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 12:12
 */

namespace Ipresso\Repository;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Ipresso\Domain\Agreement;
use Ipresso\Hydrator\AttributeHydrator;
use stdClass;

class AgreementRepository implements AgreementRepositoryInterface
{
    private $var;

    public function __construct(private readonly Client $client, private AttributeHydrator $hydrator)
    {

        /** @var  $response Response */
        $response = $this->client->get('api/2/agreement');

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());

            if (!($body instanceof stdClass)) {
                throw new Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->agreement)) {
                throw new Exception('brak pola category w odpowiedzi');
            }

            $this->var = $body->data->agreement;
        }

    }

    public function getById(int $id): Agreement
    {
        foreach ($this->var as $item) {
            if ($item->id == $id) {
                return $this->factory($item);
            }
        }
        throw new NotFoundException('nie znaleziono atrybutu: ' . $id);
    }

    public function getByName(string $name): Agreement
    {
        foreach ($this->var as $item) {
            if ($item->name === $name) {
                return $this->factory($item);
            }
        }
        throw new NotFoundException('nie znaleziono atrybutu: ' . $name);
    }

    private function factory($item): Agreement
    {
        return $this->hydrator->hydrate([
            'id' => $item->id,
            'descr' => $item->descr,
            'name' => $item->name,
            'cantDelete' => $item->cant_delete
        ], new Agreement());
    }
}