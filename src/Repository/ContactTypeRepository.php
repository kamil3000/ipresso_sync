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
    /** @var Client */
    private $client;

    /** @var ContactHydrator */
    private $hydrator;

    private $var;

    /**
     * ContactCategoryRepository constructor.
     * @param Client $client
     * @param ContactHydrator $hydrator
     */

    public function __construct( Client $client, AttributeHydrator $hydrator )
    {
        $this->client = $client;
        $this->hydrator = $hydrator;

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

                return $this->hydrator->hydrate(array(
                    'id' => $item->id,
                    'key' => $item->key,
                    'name' => $item->name
                ), new ContactType);
            }
        }
    }
}