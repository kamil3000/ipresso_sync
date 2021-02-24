<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 13.08.2018
 * Time: 21:28
 */

namespace Ipresso\Domain;


class DiseaseUnit
{
    const PKU = 'Pku';
    const KETO = 'Keto';
    const RMD = 'Rmd';
    const ALZHEIMER = 'Alzheimer';
    const DYSFAGIA = 'Dysphagia';
    const UDAR = 'Stroke';
    const DZIECI_Z_ALERGIA = 'ChildrenWithAllergies';
    const DZIECI_TUBE = 'ChildrenTube';
    const DZIECI_NUTRIJID = 'ChildrenNutrikid';
    const ODLEZYNY = 'Bedsores';
    const CANCER = 'Cancer';


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
    public function setId( int $id ): DiseaseUnit
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
    public function setKey( string $key ): DiseaseUnit
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
    public function setName( string $name ): DiseaseUnit
    {
        $this->name = $name;
        return $this;
    }


}