<?php


namespace Ipresso\Validator;


use Ipresso\Domain\Contact;

interface ValidatorInterface
{
    public function validate(Contact $contact): void ;
}