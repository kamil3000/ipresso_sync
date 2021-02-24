<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 11:29
 */

namespace Ipresso\Hydrator;

use Ipresso\Domain\Contact;
use Ipresso\Repository\AgreementRepositoryInterface;
use Ipresso\Repository\ContactCategoryRepositoryInterface;
use Ipresso\Repository\DiseaseUnitRepositoryInterface;
use Ipresso\Repository\SourceOfAdditionRepositoryInterface;

class ContactHydrator
{
    /** @var DiseaseUnitRepositoryInterface */
    private $diseaseUnitRepository;

    /** @var SourceOfAdditionRepositoryInterface */
    private $sourceOfAdditionRepository;

    /** @var AgreementRepositoryInterface */
    private $agreementRepository;

    /** @var ContactCategoryRepositoryInterface */
    private $contactCategoryRepository;

    /**
     * ContactHydrator constructor.
     * @param DiseaseUnitRepositoryInterface $diseaseUnitRepository
     * @param SourceOfAdditionRepositoryInterface $sourceOfAdditionRepository
     * @param AgreementRepositoryInterface $agreementRepository
     * @param ContactCategoryRepositoryInterface $contactCategoryRepository
     */
    public function __construct(DiseaseUnitRepositoryInterface $diseaseUnitRepository, SourceOfAdditionRepositoryInterface $sourceOfAdditionRepository, AgreementRepositoryInterface $agreementRepository, ContactCategoryRepositoryInterface $contactCategoryRepository)
    {
        $this->diseaseUnitRepository = $diseaseUnitRepository;
        $this->sourceOfAdditionRepository = $sourceOfAdditionRepository;
        $this->agreementRepository = $agreementRepository;
        $this->contactCategoryRepository = $contactCategoryRepository;
    }


    /**
     * Extract values from an object
     *
     * @param object $object
     * @return array
     */
    public function extract(Contact $contact): array
    {
        $row = array();
        if (!($contact instanceof Contact)) {
            throw new \InvalidArgumentException('jako argument wmagany obiekt klasy Ipresso\Domain\Contact ');
        }

        if ($contact->getType() !== null) {
            $row['type'] = $contact->getType()->getKey();
        }
        if ($contact->getEmail() !== null) {
            $row['email'] = $contact->getEmail();
        }
        if ($contact->getDateOfBirth() !== null) {
            $row['DateOfBirth'] = $contact->getDateOfBirth()->format('Y-m-d');
        }
        if ($contact->getDateOfRegistration() !== null) {
            $row['DateOfRegistration'] = $contact->getDateOfRegistration()->format('Y-m-d H:m:i');
        }

        if ($contact->getDiseaseUnit() !== null) {

            /** @var  $diseaseUnit \Ipresso\Domain\DiseaseUnit */
            foreach ($contact->getDiseaseUnit() as $diseaseUnit) {
                $row['DiseaseUnit'][] = $diseaseUnit->getKey();
            }
        }
        if ($contact->getSourceOfAddition() !== null) {
            $row['SourceOfAddition'] = $contact->getSourceOfAddition()->getKey();
        }
        if ($contact->getMoreThanq18() !== null) {
            $row['more_than_18'] = $contact->getMoreThanq18();
        }
        if ($contact->getCategory() !== null) {
            /** @var  $category \Ipresso\Domain\ContactCategory */
            foreach ($contact->getCategory() as $category) {
                $row['category'][$category->getId()] = 1;
            }
        }

        if ($contact->getFname() !== null) {
            $row['fname'] = (string)$contact->getFname();
        }

        if ($contact->getLname() !== null) {
            $row['lname'] = (string)$contact->getLname();
        }

        if ($contact->getMobile() !== null) {
            $row['mobile'] = (string)$contact->getMobile();
        }

        if ($contact->getPhone() !== null) {
            $row['phone'] = (string)$contact->getPhone();
        }

        if ($contact->getAgreement() !== null) {
            /** @var  $category \Ipresso\Domain\Agreement */
            foreach ($contact->getAgreement() as $agreement) {
                $row['agreement'][$agreement->getId()] = 1;
            }
        }

        if ($contact->getFormContent() !== null) {
            $row['FormContent'] = $contact->getFormContent();
        }

        if ($contact->getRegistration() !== null) {
            $row['Registration'][] = $contact->getRegistration()->getKey();
        }

        return $row;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param object $object
     * @return object
     */
    public function hydrate(array $data): Contact
    {
        /** TODO w razie potrzeby uzupełnić klase narazie mapujemy tylko to co potrzebne  */

        if (empty($data)) {
            throw new \Exception('błąd parsowania');
        }


        $contact = (new Contact())
            ->setIdContact($data['idContact'])
            ->setEmail($data['email']);

        if (isset($data['SourceOfAddition']) && !empty($data['SourceOfAddition'])) {
            $sourceOfAddition = $this->sourceOfAdditionRepository->getByName($data['SourceOfAddition']);
            $contact->setSourceOfAddition($sourceOfAddition);
        }
        if (!empty($data['agreement'])) {
            $agreementCollection = (new \Ipresso\Domain\AgreementCollection());
            foreach ($data['agreement'] as $id => $name) {
                $agreementCollection->add($this->agreementRepository->getById($id));
            }
            $contact->setAgreement($agreementCollection);
        }
        if (!empty($data['more_than_18'])) {
            $contact->setMoreThanq18($data['more_than_18']);
        }
        if (!empty($data['DateOfRegistration'])) {
            $contact->setDateOfRegistration(new \DateTime($data['DateOfRegistration']));
        }

        if (!empty($data['DateOfBirth'])) {
            $contact->setDateOfBirth(new \DateTime($data['DateOfBirth']));
        }
        if (!empty($data['fname'])) {
            $contact->setFname($data['fname']);
        }
        if (!empty($data['lname'])) {
            $contact->setLname($data['lname']);
        }
        if (!empty($data['mobile'])) {
            $contact->setMobile($data['mobile']);
        }

        if (!empty($data['phone'])) {
            $contact->setPhone($data['phone']);
        }

        if (!empty($data['FormContent'])) {
            $contact->setFormContent($data['FormContent']);
        }

        $diseaseUnitCollection = (new \Ipresso\Domain\DiseaseUnitCollection());
        if (!empty($data['DiseaseUnit'])) {
            foreach ($data['DiseaseUnit'] as $id => $name) {
                $diseaseUnitCollection->add($this->diseaseUnitRepository->getById($id));
            }
        }

        $contactCategoryCollection = (new \Ipresso\Domain\ContactCategoryCollection());
        if (!empty($data['category'])) {
            foreach ($data['category'] as $id => $name) {
                $contactCategoryCollection->add($this->contactCategoryRepository->getById($id));
            }
        }
        $contact->setCategory($contactCategoryCollection);
        $contact->setDiseaseUnit($diseaseUnitCollection);

        return $contact;

    }
}