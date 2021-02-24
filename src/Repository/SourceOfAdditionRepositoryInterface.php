<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 08:57
 */

namespace Ipresso\Repository;

use Ipresso\Domain\SourceOfAddition;

interface SourceOfAdditionRepositoryInterface
{
    public function getByKey($key): SourceOfAddition;
    public function getByName(string $name): SourceOfAddition;
}