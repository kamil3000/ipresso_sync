<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 13.08.2018
 * Time: 21:42
 */

namespace Ipresso\Domain;


class SourceOfAddition
{
    const NEOCATE_COM_PL = 'neocatecompl';
    const OPIEKANADCHORYM_PL = 'opiekanadchorympl';
    const HCP_SOUVENAID_PL = 'hcpsouvenaidpl';
    const PSILKIWCHOROBIE_PL = 'posilkiwchorobiepl';
    const SOUVENAID_PL = 'souvenaidpl';
    const CUBITAN_PL = "cubitanpl";
    const NUTRIDRINK_PL = "nutridrinkpl";
    const NUTRICIAONCOLOGY_PL = "nutriciaoncologypl";
    const PKUCONNECT_PL = "pkuconnectpl";
    const ZYWIENIEMEDYCZNE_PL = "zywieniemedycznepl";



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
     * @return SourceOfAddition
     */
    public function setId( int $id ): SourceOfAddition
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
     * @return SourceOfAddition
     */
    public function setKey( string $key ): SourceOfAddition
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
     * @return SourceOfAddition
     */
    public function setName( string $name ): SourceOfAddition
    {
        $this->name = $name;
        return $this;
    }


}