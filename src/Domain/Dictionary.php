<?php


namespace Ipresso\Domain;


class Dictionary
{
    private readonly string $value;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }


}