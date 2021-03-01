<?php

namespace Ipresso;

/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 10.08.2018
 * Time: 09:32
 */

use Exception;
use Ipresso\Domain\Contact;
use Ipresso\Hydrator\ContactHydrator;
use Ipresso\Repository\AlreadyExistsException;
use Ipresso\Repository\ContactRepositoryInterface;
use Ipresso\Security\Authentication;
use Ipresso\Services\ConnactionContact;
use Ipresso\Validator\ContactValidator;
use Psr\Container\ContainerInterface;
use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;


class Sync
{
    /** @var ContainerInterface */
    private $container;

    public function __construct()
    {
        $this->container = Container::get();
    }

    public function addOrUpdateContacts(Contact $contact)
    {
        $this->container->get(ContactValidator::class)->apiValidation($contact);

        try {
            $this->container->get(ContactRepositoryInterface::class)->add($contact);
        } catch (AlreadyExistsException $exception) {


            /** @var  $contactToUpdate Contact */
            $contactToUpdate = $this->container->get(ContactRepositoryInterface::class)->getById($exception->getMessage());


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


    public function connactionContact(Contact $contactParent, Contact $contactChild)
    {
        return $this->container->get(ConnactionContact::class)->exec($contactParent, $contactChild);
    }

    public function endpoint($callbackPut = null, $callbackDelete = null)
    {
        try {
            $this->container->get(Authentication::class)->check();
        } catch (Exception $exception) {
            return (new JsonResponse(array('error' => $exception->getMessage()), 403))->send();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $this->put($callbackPut);
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->delete($callbackDelete);
            exit;
        }

        return (new JsonResponse(array('type' => $_SERVER['REQUEST_METHOD']), 405))->send();


    }

    private function delete($callback)
    {


        if (!isset($_GET['id_contact']) or empty($_GET['id_contact'])) {
            return (new JsonResponse(array('error' => "bark parametru id_contact​ "), 422))->send();
        }
        $idContact = new stdClass();

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
            $contact = $this->container->get(ContactHydrator::class)->hydrate($body['contact']);
        } catch (Exception $exception) {
            return (new JsonResponse(array('error' => $exception->getMessage()), 400))->send();
        }

        if (gettype($callback) == 'object') {
            $callback($contact);
            exit;
        }

    }

}