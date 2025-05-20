<?php


namespace Ipresso\Domain;


class ContactAttributeString implements ContactAttributeInterface
{
    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(private readonly string $key, private readonly ?string $value)
    {
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
    public function getValue(): ?string
    {
        return $this->value;
    }
    
}