<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 14.08.2018
 * Time: 11:29
 */

namespace Ipresso\Hydrator;

use Exception;
use InvalidArgumentException;
use Ipresso\Domain\Agreement;
use Ipresso\Domain\Contact;
use Ipresso\Domain\ContactAttribute;
use Ipresso\Domain\ContactCategory;
use Ipresso\Repository\AgreementRepositoryInterface;
use Ipresso\Repository\ContactCategoryRepositoryInterface;

class ContactHydrator
{

    /** @var AgreementRepositoryInterface */
    private $agreementRepository;

    /** @var ContactCategoryRepositoryInterface */
    private $contactCategoryRepository;

    /**
     * ContactHydrator constructor.
     * @param AgreementRepositoryInterface $agreementRepository
     * @param ContactCategoryRepositoryInterface $contactCategoryRepository
     */
    public function __construct(AgreementRepositoryInterface $agreementRepository, ContactCategoryRepositoryInterface $contactCategoryRepository)
    {
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
            throw new InvalidArgumentException('jako argument wmagany obiekt klasy Ipresso\Domain\Contact ');
        }

        if ($contact->getContactType() !== null) {
            $row['type'] = $contact->getContactType()->getKey();
        }

        if ($contact->getCategory() !== null) {
            /** @var  $category ContactCategory */
            foreach ($contact->getCategory() as $category) {
                $row['category'][$category->getId()] = 1;
            }
        }


        if ($contact->getAgreement() !== null) {
            /** @var  $category Agreement */
            foreach ($contact->getAgreement() as $agreement) {
                $row['agreement'][$agreement->getId()] = 1;
            }
        }

        if (count($contact->getContactAttributeCollection()) > 0) {
            /** @var ContactAttribute $item */
            foreach ($contact->getContactAttributeCollection() as $item) {
                $row[$item->getKey()] = $item->getValue();
            }
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
        if (empty($data)) {
            throw new Exception('błąd parsowania');
        }


        $contact = new Contact($data['idContact']);


        foreach ($data as $key => $datum) {

            if (is_array($datum) || is_object($datum)) {

                if ($key === 'agreement') {
                    foreach ($datum as $id => $name) {
                        $contact->getAgreement()->add($this->agreementRepository->getById($id));
                    }
                }

                if ($key === 'category') {
                    foreach ($datum as $id => $name) {
                        $contact->getCategory()->add($this->contactCategoryRepository->getById($id));
                    }
                }

                continue;
            }


            if ($datum !== false) {

                $contact->getContactAttributeCollection()->add(new ContactAttribute($key, $datum));
            }
        }

        return $contact;

    }
}