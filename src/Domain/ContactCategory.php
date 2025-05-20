<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 19:20
 */

namespace Ipresso\Domain;


class ContactCategory
{
    const METABOLICZNY = "1";
    const CHIRURGICZNY = "2";
    const NEUROLOGICZNY = "3";
    const ONKOLOGICZNY = "4";
    const HEN_NUTRICIA_W_DOMU = "5";
    const RODZIC = "6";
    const LEKARZ = "7";
    const SZPITAL = "8";
    const FARMACEUTA = "9";
    const DIETETYK = "10";
    const PIELĘGNIARKA = "11";
    const DZIENNIKARZ = "12";
    const KORPO = "13";

    private int $id;

    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId( int $id ): ContactCategory
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName( string $name ): ContactCategory
    {
        $this->name = $name;
        return $this;
    }
}