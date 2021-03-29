<?php

use GuzzleHttp\Client;
use Ipresso\Api\Correspondent;
use Ipresso\Config\Parameters;
use Ipresso\Hydrator\AttributeHydrator;
use Ipresso\Hydrator\ContactHydrator;
use Ipresso\Repository as Repo;
use Ipresso\Security\Authentication;
use Ipresso\Services\Token\Token;
use Ipresso\Validator\ContactValidator;
use Ipresso\Validator\ApiAttributeValidator;
use Ipresso\Services\ConnactionContact;
use Ipresso\Factory\DomianObjectFactory;

return [
    DomianObjectFactory::class => function (){
        return new DomianObjectFactory();
    },
    ConnactionContact::class => function (Correspondent $correspondent) {
        return new ConnactionContact($correspondent);
    },
    Correspondent::class => function (Client $client) {
        return new Correspondent($client);
    },
    ContactValidator::class => function () {
        return new ContactValidator();
    },
    ApiAttributeValidator::class => function (Repo\ApiAttribute $apiAttribute) {
        return new ApiAttributeValidator($apiAttribute);
    },
    Authentication::class => function (Token $token) {
        return new Authentication($token);
    },
    AttributeHydrator::class => function () {
        return new AttributeHydrator();
    },
    ContactHydrator::class => static function (
        Repo\AgreementRepositoryInterface $agreementRepository,
        Repo\ContactCategoryRepositoryInterface $contactCategoryRepository,
        Repo\ContactTypeRepositoryInterface $contactTypeRepositoryInterface,
        Repo\AttributeOptionRepository $attributeOptionRepository,
        Repo\ApiAttribute $apiAttribute) {
        return new ContactHydrator($agreementRepository, $contactCategoryRepository,$contactTypeRepositoryInterface, $attributeOptionRepository, $apiAttribute);
    },
    Repo\ActivityRepository::class => function (Client $client, DomianObjectFactory $hydrator) {
        return new Repo\ActivityRepository($client,$hydrator);
    },
    Repo\TagRepository::class => function (Client $client, DomianObjectFactory $hydrator) {
        return new Repo\TagRepository($client, $hydrator);
    },
    Repo\ContactRepositoryInterface::class => function (Client $client, ContactHydrator $hydrator) {
        return new Repo\ContactRepository($client, $hydrator);
    },
    Repo\AttributeOptionRepositoryInterface::class => function (Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator) {
        return new Repo\AttributeOptionRepository($apiAttribute, $hydrator);
    },
    Repo\RegistrationRepositoryInterface::class => function (Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator) {
        return new Repo\RegistrationRepository($apiAttribute, $hydrator);
    },
    Repo\AgreementRepositoryInterface::class => function (Client $client, AttributeHydrator $hydrator) {
        return new Repo\AgreementRepository($client, $hydrator);
    },
    Repo\SourceOfAdditionRepositoryInterface::class => function (Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator) {
        return new Repo\SourceOfAdditionRepository($apiAttribute, $hydrator);
    },
    Repo\ContactTypeRepositoryInterface::class => function (Client $client, AttributeHydrator $hydrator) {
        return new Repo\ContactTypeRepository($client, $hydrator);
    },
    Repo\ContactCategoryRepositoryInterface::class => function (Client $client, AttributeHydrator $hydrator) {
        return new Repo\ContactCategoryRepository($client, $hydrator);
    },
    Repo\ApiAttribute::class => function (Client $client) {
        return new   Repo\ApiAttribute($client);
    },
    Client::class => DI\factory(static function (Token $token) {

        return new Client([
            'timeout' => 5.0,
            'base_uri' => Parameters::getClientUrl(),
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'IPRESSO_TOKEN' => $token->getToken(),
                'User-Agent' => 'iPresso'
            ]]);


    }),
    Token::class => function () {
        return new Token();
    },
];