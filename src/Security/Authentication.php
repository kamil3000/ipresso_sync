<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 21:29
 */

namespace Ipresso\Security;

use Ipresso\Services\Token\Token;

class Authentication
{
    /** @var Token */
    private $token;

    /**
     * Authentication constructor.
     * @param Token $token
     */
    public function __construct( Token $token )
    {
        $this->token = $token;
    }


    public function check()
    {
        $incomingToken = $this->findTokenInHeaders();

        if ($incomingToken === null) {
                throw new NoTokenException();
        }

        if ($incomingToken != $this->token->getToken() ) {
                throw new WrongTokenException();
        }
    }

    private function findTokenInHeaders()
    {
        $headers = apache_request_headers();

        foreach ($headers as $header => $value) {
            if ($header == 'IPRESSO_TOKEN') {
                return $value;
            }
        }
    }
}