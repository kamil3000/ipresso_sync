<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 10:40
 */

namespace Ipresso\Repository;

use GuzzleHttp\Client;
use Ipresso\Domain\ContactCategory;
use Ipresso\Hydrator\AttributeHydrator;

class ContactCategoryRepository implements ContactCategoryRepositoryInterface
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

        /** @var  $response \GuzzleHttp\Psr7\Response */
        $response = $this->client->get('api/2/category');


        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());
            if (!($body instanceof \stdClass)) {
                throw new \Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->category)) {
                throw new \Exception('brak pola category w odpowiedzi');
            }

            $this->var = $body->data->category;
        }

    }


    public function getById( $id ): ContactCategory
    {

        foreach ($this->var as $k => $v) {
            if ($id == $k) {
                return $this->hydrator->hydrate(array(
                    'id' => $k,
                    'name' => $v
                ), new ContactCategory);
            }
        }
        throw new NotFoundException('nie znaleziono atrybutu');
    }
}