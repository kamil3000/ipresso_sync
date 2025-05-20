<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:11
 */

namespace Ipresso\Repository;

use Ipresso\Domain\DiseaseUnit;

interface DiseaseUnitRepositoryInterface
{
    public function getByKey($key) : DiseaseUnit;

    public function getById($id) : DiseaseUnit;
}