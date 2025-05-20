<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace Ipresso\Repository;

use Ipresso\Domain\Registration;

interface RegistrationRepositoryInterface
{
    public function getByKey($key): Registration;

}