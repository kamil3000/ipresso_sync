<?php

namespace Ipresso\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Correspondent
{
    private Client $client;

    /**
     * Correspondent constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function connactionContact(int $contactMaster, int $contactSlave)
    {
        $formParams = [];
        $formParams['connection'] = [
            $contactSlave
        ];

        /** @var  $response Response */
        $response = $this->client->post('api/2/contact/' . $contactMaster . '/connection', [
            'form_params' => $formParams
        ]);

        return $response;

    }

}