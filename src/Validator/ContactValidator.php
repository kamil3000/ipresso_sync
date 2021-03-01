<?php

namespace Ipresso\Validator;

use Ipresso\Domain\Contact;
use Ipresso\Domain\ContactAttribute;
use Ipresso\Enum\ApiAttributeKey;

class ContactValidator implements ValidatorInterface
{
    public function validate(Contact $contact): void
    {
        $pass = false;

        $oneShouldExist = [ApiAttributeKey::EMAIL, ApiAttributeKey::MOBILE, ApiAttributeKey::NAME, ApiAttributeKey::LAST_NAME];

        /** @var ContactAttribute $item */
        foreach ($contact->getContactAttributeCollection() as $item) {
            if (!$pass && in_array($item->getKey(), $oneShouldExist)) {
                $pass = true;
            }
        }
        if (!$pass) {
            throw new ValidatorException('One should exist ' . implode(',', $oneShouldExist));
        }
    }
}