<?php


namespace Ipresso\Validator;

use Ipresso\Repository\ApiAttribute;
use Ipresso\Domain\Contact;
use Ipresso\Domain\ContactAttributeInterface;
use Ipresso\Domain\ContactAttributeArrayOption;

class ApiAttributeValidator implements ValidatorInterface
{
    private $attr;

    /**
     * ApiAttributeValidator constructor.
     * @param ApiAttribute $apiAttribute
     */
    public function __construct(private readonly ApiAttribute $apiAttribute)
    {
        $this->attr = $this->apiAttribute->getAttribute();
    }

    public function validate(Contact $contact): void
    {
        /** @var ContactAttributeInterface $item */
        foreach ($contact->getContactAttributeCollection() as $item) {

            $apiAttribute = $this->getApiAttribute($item->getKey());
            if ($apiAttribute === null) {
                throw new ValidatorException('attribute ' . $item->getKey() . ' does not exist in iPresso');
            }

            if ($item instanceof \Ipresso\Domain\ContactAttributeArray) {

                foreach ($item->getValue() as $option) {
                    if(!$this->getApiAttributeOption($apiAttribute, $option)){
                        throw new ValidatorException('attribute option ' . $option->getKey() . ' does not match '.$item->getKey());
                    }
                }
            }

            /**
             *  TODO sprawdzić typ atrybutu
             */
        }

    }

    private function getApiAttributeOption($apiAttribute, ContactAttributeArrayOption $option):bool
    {
        foreach ($apiAttribute->optionsByKey as $key => $value) {
            if ((int)$value === $option->getId() && $key === $option->getKey()) {
                return true;
            }
        }
        return false;
    }

    private function getApiAttribute($attrName)
    {
        foreach ($this->attr as $key => $item) {
            if ($attrName === $key) {
                return $item;
            }
        }

        return null;

    }
}