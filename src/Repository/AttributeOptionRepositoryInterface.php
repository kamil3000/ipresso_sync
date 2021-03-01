<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace Ipresso\Repository;

use Ipresso\Domain\ContactAttributeArrayOption;

interface AttributeOptionRepositoryInterface
{
    public function getByKey($attr, $key): ContactAttributeArrayOption;

    public function getById($attr, $id): ContactAttributeArrayOption;
}