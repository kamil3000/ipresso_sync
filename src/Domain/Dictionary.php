<?php


namespace Ipresso\Domain;


class Dictionary
{
    private string $value;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }


}