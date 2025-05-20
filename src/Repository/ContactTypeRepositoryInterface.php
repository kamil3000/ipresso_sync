<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 11:38
 */

namespace Ipresso\Repository;

use Ipresso\Domain\ContactType;

interface ContactTypeRepositoryInterface
{
    public function getByKey( $key ): ContactType;
}