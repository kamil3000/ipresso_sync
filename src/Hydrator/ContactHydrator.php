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
use Ipresso\Domain\ContactAttributeArray;
use Ipresso\Domain\ContactAttributeInt;
use Ipresso\Domain\ContactAttributeInterface;
use Ipresso\Domain\ContactAttributeString;
use Ipresso\Domain\ContactCategory;
use Ipresso\Repository\AgreementRepositoryInterface;
use Ipresso\Repository\AttributeOptionRepository;
use Ipresso\Repository\ContactCategoryRepositoryInterface;
use Ipresso\Repository\ApiAttribute;
use Ipresso\Repository\ContactTypeRepositoryInterface;

class ContactHydrator
{

    /** @var AgreementRepositoryInterface */
    private $agreementRepository;

    /** @var ContactCategoryRepositoryInterface */
    private $contactCategoryRepository;

    /** @var ContactTypeRepositoryInterface */
    private $contactTypeRepositoryInterface;

    /** @var AttributeOptionRepository */
    private $attributeOptionRepository;

    /** @var ApiAttribute */
    private $apiAttribute;

    /**
     * ContactHydrator constructor.
     * @param AgreementRepositoryInterface $agreementRepository
     * @param ContactCategoryRepositoryInterface $contactCategoryRepository
     * @param ContactTypeRepositoryInterface $contactTypeRepositoryInterface
     * @param AttributeOptionRepository $attributeOptionRepository
     * @param ApiAttribute $apiAttribute
     */
    public function __construct(
        AgreementRepositoryInterface $agreementRepository,
        ContactCategoryRepositoryInterface $contactCategoryRepository,
        ContactTypeRepositoryInterface $contactTypeRepositoryInterface,
        AttributeOptionRepository $attributeOptionRepository,
        ApiAttribute $apiAttribute
    ) {
        $this->agreementRepository = $agreementRepository;
        $this->contactCategoryRepository = $contactCategoryRepository;
        $this->contactTypeRepositoryInterface = $contactTypeRepositoryInterface;
        $this->attributeOptionRepository = $attributeOptionRepository;
        $this->apiAttribute = $apiAttribute;
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
                $row['agreement'][$agreement->getId()] = $agreement->isToRemove() ? 2 : 1 ;
            }
        }

        if (count($contact->getContactAttributeCollection()) > 0) {
            /** @var ContactAttributeInterface $item */
            foreach ($contact->getContactAttributeCollection() as $item) {
                if ($item instanceof ContactAttributeArray) {
                    $row[$item->getKey()] = [];
                    foreach ($item->getValue() as $attributeArrayOption) {
                        $row[$item->getKey()][] = $attributeArrayOption->getKey();
                    }
                    continue;
                }

                $row[$item->getKey()] = $item->getValue();
            }
        }
        if ($contact->getSource()->hasValue()) {
            $row['source'] = [];
            if ($contact->getSource()->getUtmCampaign() !== null) {
                $row['source']['utm_campaign'] = $contact->getSource()->getUtmCampaign();
            }

            if ($contact->getSource()->getUtmContent() !== null) {
                $row['source']['utm_content'] = $contact->getSource()->getUtmContent();
            }
            if ($contact->getSource()->getUtmMedium() !== null) {
                $row['source']['utm_medium'] = $contact->getSource()->getUtmMedium();
            }
            if ($contact->getSource()->getUtmSource() !== null) {
                $row['source']['utm_source'] = $contact->getSource()->getUtmSource();
            }
            if ($contact->getSource()->getUtmTerm() !== null) {
                $row['source']['utm_term'] = $contact->getSource()->getUtmTerm();
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
            if ($key === 'agreement') {
                foreach ($datum as $id => $name) {
                    $contact->getAgreement()->add($this->agreementRepository->getById($id));
                }
                continue;
            }

            if ($key === 'category') {
                foreach ($datum as $id => $name) {
                    $contact->getCategory()->add($this->contactCategoryRepository->getById($id));
                }
                continue;
            }

            if ($key === 'type') {
                $contact->setContactType($this->contactTypeRepositoryInterface->getByKey($datum));
            }

            if ((is_array($datum) || is_object($datum)) && $this->apiAttribute->attributeIsset($key)) {
                $attributeArray = new ContactAttributeArray($key, []);
                foreach ($datum as $attrId => $name) {
                    $attributeArray->addItem($this->attributeOptionRepository->getById($key, (int)$attrId));
                }
                $contact->getContactAttributeCollection()->add($attributeArray);
                continue;
            }


            if ($datum !== false) {
                if (is_int($datum)) {
                    $contact->getContactAttributeCollection()->add(new ContactAttributeInt($key, $datum));
                    continue;
                }
                if (is_string($datum)) {
                    $contact->getContactAttributeCollection()->add(new ContactAttributeString($key, $datum));
                    continue;
                }
//                dd($key, $datum);


            }
        }

        return $contact;
    }
}