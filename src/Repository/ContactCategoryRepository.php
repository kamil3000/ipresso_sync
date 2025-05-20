<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 10:40
 */

namespace Ipresso\Repository;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Ipresso\Domain\ContactCategory;
use Ipresso\Hydrator\AttributeHydrator;
use stdClass;

class ContactCategoryRepository implements ContactCategoryRepositoryInterface
{



    private $var;

    public function __construct(private readonly Client $client,private readonly AttributeHydrator $hydrator)
    {
        /** @var  $response Response */
        $response = $this->client->get('api/2/category');


        if ($response->getStatusCode() == 200) {
            $body = json_decode((string)$response->getBody());
            if (!($body instanceof stdClass)) {
                throw new Exception('bład parsowania odpowiedzi');
            }
            if (!isset($body->data->category)) {
                throw new Exception('brak pola category w odpowiedzi');
            }

            $this->var = $body->data->category;
        }

    }


    public function getById(int $id): ContactCategory
    {
        foreach ($this->var as $k => $v) {
            if ($id == $k) {
                return $this->hydrator->hydrate([
                    'id' => $k,
                    'name' => $v
                ], new ContactCategory);
            }
        }
        throw new NotFoundException('nie znaleziono atrybutu: ' . $id);
    }

    public function getByKey(string $key): ContactCategory
    {
        foreach ($this->var as $k => $v) {
            if ($key === $v) {
                return $this->hydrator->hydrate([
                    'id' => $k,
                    'name' => $v
                ], new ContactCategory);
            }
        }
        throw new NotFoundException('nie znaleziono atrybutu: ' . $id);
    }

}