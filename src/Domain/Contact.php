<?php

namespace Ipresso\Domain;


/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 14:43
 */
class Contact
{
    /** @var ContactAttributeCollection  */
    private  $contactAttributeCollection;

    /** @var ContactCategoryCollection  */
    private  $category;

    /** @var AgreementCollection  */
    private  $agreement;

    /** @var ContactType|null  */
    private  $contactType = null;

    /** @var ContactSource */
    private $source;


    /**
     * @param int|null $idContact
     */
    public function __construct(private $idContact = null)
    {
        $this->contactAttributeCollection = new ContactAttributeCollection;
        $this->category = new ContactCategoryCollection;
        $this->agreement = new AgreementCollection;
        $this->source = new ContactSource;
    }

    public function getSource(): ContactSource
    {
        return $this->source;
    }

    public function setSource(ContactSource $source): Contact
    {
        $this->source = $source;
        return $this;
    }

    public function getContactType(): ?ContactType
    {
        return $this->contactType;
    }

    public function setContactType(ContactType $contactType): void
    {
        $this->contactType = $contactType;
    }

    public function getContactAttributeCollection(): ContactAttributeCollection
    {
        return $this->contactAttributeCollection;
    }


    public function getCategory(): ContactCategoryCollection
    {
        return $this->category;
    }

    /**
     * @param int|null $idContact
     */
    public function setIdContact(?int $idContact): void
    {
        $this->idContact = $idContact;
    }


    public function getAgreement(): AgreementCollection
    {
        return $this->agreement;
    }

    /**
     * @return int|null
     */
    public function getIdContact(): ?int
    {
        return $this->idContact;
    }


}