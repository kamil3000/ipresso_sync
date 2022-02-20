<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 13:14
 */

namespace Ipresso\Repository;

use Ipresso\Domain\Contact;

interface ContactRepositoryInterface
{

    public function add( Contact $contact );

    public function update( Contact $contact );

    public function getById( $id );

    public function findByEmail(string $email): array ;

}