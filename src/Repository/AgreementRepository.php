<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 12:12
 */

namespace Ipresso\Repository;

use GuzzleHttp\Client;
use Ipresso\Domain\Agreement;
use Ipresso\Hydrator\AttributeHydrator;

class AgreementRepository implements AgreementRepositoryInterface
{
    /** @var Client */
    private $client;

    /** @var ContactHydrator */
    private $hydrator;


    /**
     * DiseaseUnitRepository constructor.
     * @param \Ipresso\Repository\ApiAttribute $apiAttribute
     */
    public function __construct( Client $client, AttributeHydrator $hydrator )
    {
        $this->client = $client;
        $this->hydrator = $hydrator;

        /** @var  $response \GuzzleHttp\Psr7\Response */
        $response = $this->client->get('api/2/agreement');


        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());

            if (!($body instanceof \stdClass)) {
                throw new \Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->agreement)) {
                throw new \Exception('brak pola category w odpowiedzi');
            }


            $this->var = $body->data->agreement;
        }

    }

    public function getById( $id )
    {
        foreach ($this->var as $item){

            if($item->id == $id){

                return $this->hydrator->hydrate(array(
                    'id' => $item->id,
                    'descr' => $item->descr,
                    'name' => $item->name,
                    'cantDelete' => $item->cant_delete
                ), new Agreement());
            }
        }
    }
}