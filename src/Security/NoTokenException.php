<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 21:49
 */

namespace Ipresso\Security;


class NoTokenException extends \Exception
{
        protected $message = 'No token';
}