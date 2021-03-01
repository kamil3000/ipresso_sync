<?php


namespace Ipresso\Domain;


class ContactAttributeArray implements ContactAttributeInterface
{
    private string  $key;
    private array $value;

    /**
     * ContactAttribute constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key, array $value = [])
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
     * @return ContactAttributeArrayOption[]
     */
    public function getValue(): array
    {
        return $this->value;
    }

    public function addItem(ContactAttributeArrayOption $option)
    {

        $this->value[] = $option;

        return $this;

    }

}