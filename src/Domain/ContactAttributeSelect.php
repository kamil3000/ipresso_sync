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
    public function __construct(string $key, ContactAttributeInterface $value)
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

    /**
     * @return ContactAttributeArrayOption
     */
    public function getValue(): ContactAttributeArrayOption
    {
        return $this->value->getKey();
    }

}