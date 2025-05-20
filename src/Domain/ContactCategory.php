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

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ContactCategory
     */
    public function setId( int $id ): ContactCategory
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ContactCategory
     */
    public function setName( string $name ): ContactCategory
    {
        $this->name = $name;
        return $this;
    }

}