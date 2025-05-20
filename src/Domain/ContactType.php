<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 18:24
 */

namespace Ipresso\Domain;


class ContactType
{
    const PACJENT = 'Patient';
    const HCP = 'Hcp';
    const INNE = 'Other';

    /** @var int */
    private $id;

    /** @var string */
    private $key;

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
     * @return ContactType
     */
    public function setId( int $id ): ContactType
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return ContactType
     */
    public function setKey( string $key ): ContactType
    {
        $this->key = $key;
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
     * @return ContactType
     */
    public function setName( string $name ): ContactType
    {
        $this->name = $name;
        return $this;
    }

    
}