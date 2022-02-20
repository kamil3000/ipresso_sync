<?php


namespace Ipresso\Domain;


class ContactAttributeArray implements ContactAttributeInterface
{
    /** @var string */
    private $key;

    /** @var ContactAttributeArrayOption[] */
    private $value;

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

    public function addItem(ContactAttributeArrayOption $option): self
    {
        $this->value[] = $option;
        return $this;
    }

    public function hasItem(ContactAttributeArrayOption $option): bool
    {
        /** @var ContactAttributeArrayOption $item */
        foreach ($this->value as $item) {
            if ($item->getId() === $option->getId()) {
                return true;
            }
        }
        return false;
    }

}