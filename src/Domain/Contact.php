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
    /** @var int */
    private $idContact;

    /** @var string */
    private $fname;

    /** @var string */
    private $lname;

    /** @var string */
    private $mobile;

    /** @var string */
    private $phone;

    /** @var string */
    private $email;

    /** @var boolean */
    private $moreThanq18;

    /** @var  ContactType */
    private $type;

    /** @var ContactCategoryCollection */
    private $category;

    /** @var  \DateTime */
    private $DateOfBirth;

    /** @var DiseaseUnitCollection */
    private $DiseaseUnit;

    /** @var SourceOfAddition */
    private $SourceOfAddition;


    /** @var AgreementCollection */
    private $agreement;

    /** @var string */
    private $FormContent;

    /** @var Registration */
    private $registration;

    /** @var \DateTime */
    private $dateOfRegistration;

    /**
     * @return \DateTime
     */
    public function getDateOfRegistration()
    {
        return $this->dateOfRegistration;
    }

    /**
     * @param \DateTime $dateOfRegistration
     * @return Contact
     */
    public function setDateOfRegistration(\DateTime $dateOfRegistration): Contact
    {
        $this->dateOfRegistration = $dateOfRegistration;
        return $this;
    }


    /**
     * @return Registration
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @return bool
     */
    public function getMoreThanq18()
    {
        return $this->moreThanq18;
    }

    /**
     * @param bool $moreThanq18
     * @return Contact
     */
    public function setMoreThanq18(bool $moreThanq18): Contact
    {
        $this->moreThanq18 = $moreThanq18;
        return $this;
    }


    /**
     * @param Registration $registration
     * @return Contact
     */
    public function setRegistration(Registration $registration)
    {
        $this->registration = $registration;
        return $this;
    }


    /**
     * @return int
     */
    public function getIdContact()
    {
        return $this->idContact;
    }

    /**
     * @param int $idContact
     * @return Contact
     */
    public function setIdContact(int $idContact): Contact
    {
        $this->idContact = $idContact;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }


    /**
     * @return DiseaseUnitCollection
     */
    public function getDiseaseUnit()
    {
        return $this->DiseaseUnit;
    }

    /**
     * @param DiseaseUnitCollection $DiseaseUnit
     * @return Contact
     */
    public function setDiseaseUnit(DiseaseUnitCollection $DiseaseUnit): Contact
    {
        $this->DiseaseUnit = $DiseaseUnit;
        return $this;
    }


    /**
     * @return SourceOfAddition
     */
    public function getSourceOfAddition()
    {
        return $this->SourceOfAddition;
    }

    /**
     * @param SourceOfAddition $SourceOfAddition
     * @return Contact
     */
    public function setSourceOfAddition(SourceOfAddition $SourceOfAddition): Contact
    {
        $this->SourceOfAddition = $SourceOfAddition;
        return $this;
    }


    /**
     * @return ContactCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ContactCategory $category
     * @return Contact
     */
    public function setCategory(ContactCategoryCollection $category)
    {
        $this->category = $category;
        return $this;
    }


    /**
     * @return \Ipresso\Domain\ContactType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \Ipresso\Domain\ContactType $type
     * @return Contact
     */
    public function setType(ContactType $type)
    {
        $this->type = $type;
        return $this;
    }


    /**
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param string $fname
     * @return Contact
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param string $lname
     * @return Contact
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $phone
     * @return Contact
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->DateOfBirth;
    }

    /**
     * @param \DateTime $DateOfBirth
     * @return Contact
     */
    public function setDateOfBirth($DateOfBirth)
    {
        $this->DateOfBirth = $DateOfBirth;
        return $this;
    }

    /**
     * @return AgreementCollection
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    /**
     * @param AgreementCollection $agreement
     * @return Contact
     */
    public function setAgreement(AgreementCollection $agreement): Contact
    {
        $this->agreement = $agreement;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormContent()
    {
        return $this->FormContent;
    }

    /**
     * @param string $FormContent
     * @return Contact
     */
    public function setFormContent(string $FormContent): Contact
    {
        $this->FormContent = $FormContent;
        return $this;
    }


}