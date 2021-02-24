<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 10:39
 */

namespace Ipresso\Repository;

use Ipresso\Domain\ContactCategory;

interface ContactCategoryRepositoryInterface
{
        public function getById($id) : ContactCategory;
}