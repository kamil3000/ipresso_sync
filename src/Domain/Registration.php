<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 13.08.2018
 * Time: 21:28
 */

namespace Ipresso\Domain;


class Registration
{
    const NEOCATE = 'Neocate';
    const PKUCONNECT = 'Pkuconnect';


    /** @var int */
    private $id;

    /** @var string */
    private $key;

    /** @var string */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DiseaseUnit
     */
    public function setId( int $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return DiseaseUnit
     */
    public function setKey( string $key )
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DiseaseUnit
     */
    public function setName( string $name )
    {
        $this->name = $name;
        return $this;
    }


}