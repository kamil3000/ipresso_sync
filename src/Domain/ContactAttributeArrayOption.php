<?php


namespace Ipresso\Domain;


class ContactAttributeArrayOption
{
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
     * @return DiseaseUnit
     */
    public function setId( int $id ): ContactAttributeArrayOption
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
     * @return DiseaseUnit
     */
    public function setKey( string $key ): ContactAttributeArrayOption
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
     * @return DiseaseUnit
     */
    public function setName( string $name ): ContactAttributeArrayOption
    {
        $this->name = $name;
        return $this;
    }
}