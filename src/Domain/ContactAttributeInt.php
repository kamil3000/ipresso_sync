<?php


namespace Ipresso\Domain;


class ContactAttributeInt implements ContactAttributeInterface
{
    /** @var string  */
    private $key;

    /** @var int|null  */
    private $value;

    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key,?int $value)
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


    public function getValue(): ?int
    {
        return $this->value;
    }

}