<?php


namespace Ipresso\Domain;


class ContactAttributeSelect implements ContactAttributeInterface
{
    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(private readonly string $key, private readonly ContactAttributeArrayOption $value)
    {
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }


    public function getValue()
    {
        return $this->value->getKey();
    }

}