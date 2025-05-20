<?php

namespace Ipresso\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Correspondent
{
    public function __construct(private readonly Client $client)
    {
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