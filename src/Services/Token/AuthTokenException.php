<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 13:01
 */

namespace Ipresso\Services\Token;


class AuthTokenException extends \Exception
{
    protected $message = 'błąd atoryzacji';
}