<?php


namespace Ipresso\Domain;


class ContactAttributeSelect implements ContactAttributeInterface
{
    /** @var string  */
    private $key;

    /** @var ContactAttributeArrayOption */
    private  $value;

    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key, ContactAttributeArrayOption $value)
    {
        $this->key = $key;
        $this->value = $value;
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