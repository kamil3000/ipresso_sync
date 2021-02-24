<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 21:50
 */

namespace Ipresso\Security;


class WrongTokenException extends \Exception
{
        protected $message = 'Wrong token';
}