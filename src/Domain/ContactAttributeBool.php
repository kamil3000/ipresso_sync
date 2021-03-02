<?php


namespace Ipresso\Domain;


class ContactAttributeBool implements ContactAttributeInterface
{
    /** @var string  */
    private  $key;

    /** @var bool|null  */
    private  $value;

    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key,?bool $value)
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


    public function getValue(): ?bool
    {
        return $this->value;
    }

}