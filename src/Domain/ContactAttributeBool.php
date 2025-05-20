<?php


namespace Ipresso\Domain;


class ContactAttributeBool implements ContactAttributeInterface
{
    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(private readonly string $key, private readonly ?bool $value)
    {
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }


    public function getValue(): ?bool
    {
        return $this->value;
    }

}