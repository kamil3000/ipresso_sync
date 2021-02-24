<?php

namespace Ipresso;

/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 09:32
 */

use Ipresso\Domain\Contact;
use Ipresso\Repository\AlreadyExistsException;
use Ipresso\Repository\ContactRepositoryInterface;
use Ipresso\Security\Authentication;
use Psr\Container\ContainerInterface;


class Sync
{
    /** @var ContainerInterface */
    private $container;

    public function __construct()
    {
        $this->container = Container::get();
    }

    public function addContacts(\Ipresso\Domain\Contact $contact)
    {
        try {
            $this->container->get(ContactRepositoryInterface::class)->add($contact);
        } catch (AlreadyExistsException $exception) {


            /** @var  $contactToUpdate Contact */
            $contactToUpdate = $this->container->get(ContactRepositoryInterface::class)->getById($exception->getMessage());


            if (!empty($contact->getFormContent())) {
                $contactToUpdate
                    ->setFormContent($contact->getFormContent());
            }

            if (!empty($contact->getFname())) {
                $contactToUpdate
                    ->setFname($contact->getFname());
            }

            if (!empty($contact->getLname())) {
                $contactToUpdate
                    ->setLname($contact->getLname());
            }

            if (!empty($contact->getPhone())) {
                $contactToUpdate
                    ->setPhone($contact->getPhone());
            }

            if (!empty($contact->getMobile())) {
                $contactToUpdate
                    ->setMobile($contact->getMobile());
            }

            foreach ($contact->getDiseaseUnit() as $diseaseUnit) {
                if (!$contactToUpdate->getDiseaseUnit()->has($diseaseUnit)) {
                    $contactToUpdate->getDiseaseUnit()->add($diseaseUnit);
                }
            }

            foreach ($contact->getCategory() as $category) {

                if (!$contactToUpdate->getCategory()->has($category)) {
                    $contactToUpdate->getCategory()->add($category);
                }
            }

            foreach ($contact->getAgreement() as $agreement) {
                if (!$contactToUpdate->getAgreement()->has($agreement)) {
                    $contactToUpdate->getAgreement()->add($agreement);
                }
            }

            $this->container->get(ContactRepositoryInterface::class)->update($contactToUpdate);

        }

        return $contact;
    }

    public function endpoint($callbackPut = null, $callbackDelete = null)
    {
        try {
            $this->container->get(Authentication::class)->check();
        } catch (\Exception $exception) {
            return (new \Symfony\Component\HttpFoundation\JsonResponse(array('error' => $exception->getMessage()), 403))->send();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $this->put($callbackPut);
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->delete($callbackDelete);
            exit;
        }

        return (new \Symfony\Component\HttpFoundation\JsonResponse(array('type' => $_SERVER['REQUEST_METHOD']), 405))->send();


    }

    private function delete($callback)
    {


        if (!isset($_GET['id_contact']) or empty($_GET['id_contact'])) {
            return (new \Symfony\Component\HttpFoundation\JsonResponse(array('error' => "bark parametru id_contact​ "), 422))->send();
        }
        $idContact = new \stdClass();

        foreach ($_GET as $key => $val) {
            $idContact->{$key} = $val;
        }

        if (gettype($callback) == 'object') {
            $callback($idContact);
            exit;
        }

    }

    private function put($callback)
    {

        $body = json_decode(file_get_contents('php://input'), true);
        try {
            $contact = $this->container->get(\Ipresso\Hydrator\ContactHydrator::class)->hydrate($body['contact']);
        } catch (\Exception $exception) {
            return (new \Symfony\Component\HttpFoundation\JsonResponse(array('error' => $exception->getMessage()), 400))->send();
        }

        if (gettype($callback) == 'object') {
            $callback($contact);
            exit;
        }

    }

}