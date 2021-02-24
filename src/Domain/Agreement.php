<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 20.08.2018
 * Time: 12:07
 */

namespace Ipresso\Domain;


class Agreement
{
    const  HANDLOWA = '12';
    const  PROFILOWANIE = '14';
    const  MAIL_TELEFON = '11';
    const  ZDROWIE = '13';
    const  KONKURS = '15';

    /** @var int */
    private $id;

    /** @var string */
    private $descr;

    /** @var string */
    private $name;

    private $cant_delete;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Agreement
     */
    public function setId( int $id ): Agreement
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescr(): string
    {
        return $this->descr;
    }

    /**
     * @param string $descr
     * @return Agreement
     */
    public function setDescr( string $descr ): Agreement
    {
        $this->descr = $descr;
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
     * @return Agreement
     */
    public function setName( string $name ): Agreement
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCantDelete()
    {
        return $this->cant_delete;
    }

    /**
     * @param mixed $cant_delete
     * @return Agreement
     */
    public function setCantDelete( $cant_delete )
    {
        $this->cant_delete = $cant_delete;
        return $this;
    }





}