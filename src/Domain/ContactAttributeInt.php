<?php


namespace Ipresso\Domain;


class ContactAttributeInt implements ContactAttributeInterface
{
    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(private readonly string $key, private readonly ?int $value)
    {
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }


    public function getValue(): ?int
    {
        return $this->value;
    }

}