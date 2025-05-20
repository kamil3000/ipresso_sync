<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 12:12
 */

namespace Ipresso\Repository;


use Ipresso\Domain\Agreement;

interface AgreementRepositoryInterface
{
    public function getById(int $key): Agreement;

    public function getByName(string $name): Agreement;
}