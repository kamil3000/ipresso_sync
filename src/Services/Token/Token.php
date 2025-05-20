<?php

namespace Ipresso\Services\Token;

use GuzzleHttp\Client;
use Ipresso\Config\Parameters;

/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 12:46
 */
class Token
{
    const STORAGE_KEY = 'IPressoToken';

    /** @var Client */
    private $client;

    private $token;

    /**
     * Token constructor.
     * @param Client $client
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => Parameters::getClientUrl(),
        ]);
    }


    private function getTokenFromStorage()
    {
        return $this->token;

        if (session_id() === '') {
            session_start();
        }

        if (!isset($_SESSION[self::STORAGE_KEY])) {
            $_SESSION[self::STORAGE_KEY] = "";
        }

        return $_SESSION[self::STORAGE_KEY];
    }

    private function storageToken( $token )
    {
        //      $_SESSION[self::STORAGE_KEY] = $token;

        $this->token = $token;
    }

    private function getTokenFromApi()
    {
        $credentials = base64_encode(Parameters::getLogin() . ':' . Parameters::getPass());

        /** @var  $response \GuzzleHttp\Psr7\Response */
        $response = $this->client->request('GET', 'api/2/auth/' . Parameters::getCostumerKey(), ['headers' => [
            'Authorization' => 'Basic ' . $credentials,
        ]]);
        if ($response->getStatusCode() == 200) {
            $stringBody = (string)$response->getBody();

            $objectBody = json_decode($stringBody);

            if (isset($objectBody->data)) {
                return $objectBody->data;
            }
        }
        return "";

    }

    public function getToken(): string
    {
        $token = $this->getTokenFromStorage();

        if (empty($token)) {
            $token = $this->getTokenFromApi();

            if (!empty($token)) {
                $this->storageToken($token);
            }
        }

        if (empty($token)) {
            throw new AuthTokenException();
        }

        return $token;
    }
}