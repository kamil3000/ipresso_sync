<?php

namespace Ipresso\Domain;
/**
 * @deprecated use typed attributes
 */
class ContactAttribute implements  ContactAttributeInterface
{
    /** @var string  */
    private $key;

    /** @var string  */
    private $value;

    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key, string $value)
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
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }


}