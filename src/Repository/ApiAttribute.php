<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 14:46
 */

namespace Ipresso\Repository;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ApiAttribute
{
    /**
     * ApiAttribute constructor.
     * @param Client $client
     */

    private $attribute;

    public function __construct(private readonly Client $client)
    {
        {
            /** @var  $response Response */
            $response = $this->client->get('api/2/attribute');

            $body = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200) {

                $this->attribute = $body->data->attribute;
            }

        }

    }

    /**
     * @return mixed
     */
    public function getAttribute()
    {
        return $this->attribute;
    }


    public function attributeIsset($name)
    {
        return isset($this->attribute->{$name});
    }


}