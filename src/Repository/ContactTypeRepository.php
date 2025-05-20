<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 11:38
 */

namespace Ipresso\Repository;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Ipresso\Domain\ContactType;
use Ipresso\Hydrator\AttributeHydrator;
use stdClass;

class ContactTypeRepository implements ContactTypeRepositoryInterface
{
    private $var;

    public function __construct( private readonly Client $client,private AttributeHydrator $hydrator )
    {

        /** @var  $response Response */
        $response = $this->client->get('api/2/type');

        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());


            if (!($body instanceof stdClass)) {
                throw new Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->type)) {
                throw new Exception('brak pola category w odpowiedzi');
            }

            $this->var = $body->data->type;
        }

    }

    public function getByKey( $key ): ContactType
    {
        foreach ($this->var as $item){
            if($item->key == $key){
                return $this->hydrator->hydrate([
                    'id' => $item->id,
                    'key' => $item->key,
                    'name' => $item->name
                ], new ContactType);
            }
        }
        throw new Exception('brak klucza : '.$key);
    }
}