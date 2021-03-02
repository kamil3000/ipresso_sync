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

    /** @var int|null  */
    private  $idContact;

    /** @var ContactType|null  */
    private  $contactType = null;


    public function __construct($idContact = null)
    {
        $this->contactAttributeCollection = new ContactAttributeCollection;
        $this->category = new ContactCategoryCollection;
        $this->agreement = new AgreementCollection;
        $this->idContact = $idContact;
    }

    /**
     * @return ContactType
     */
    public function getContactType(): ?ContactType
    {
        return $this->contactType;
    }

    /**
     * @param ContactType $contactType
     */
    public function setContactType(ContactType $contactType): void
    {
        $this->contactType = $contactType;
    }


    /**
     * @return ContactAttributeCollection
     */
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