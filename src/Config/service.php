<?php

use GuzzleHttp\Client;
use Ipresso\Config\Parameters;
use Ipresso\Hydrator\AttributeHydrator;
use Ipresso\Hydrator\ContactHydrator;
use Ipresso\Repository as Repo;
use Ipresso\Security\Authentication;
use Ipresso\Services\Token\Token;

return [
    Authentication::class => function ( Token $token ) {
        return new Authentication($token);
    },
    AttributeHydrator::class => function () {
        return new AttributeHydrator();
    },
    ContactHydrator::class => function ( Repo\DiseaseUnitRepositoryInterface $diseaseUnitRepository, Repo\SourceOfAdditionRepositoryInterface $sourceOfAdditionRepository, Repo\AgreementRepositoryInterface $agreementRepository , Repo\ContactCategoryRepositoryInterface $contactCategoryRepository) {
        return new ContactHydrator($diseaseUnitRepository, $sourceOfAdditionRepository, $agreementRepository,$contactCategoryRepository);
    },
    Repo\ContactRepositoryInterface::class => function ( Client $client, ContactHydrator $hydrator ) {
        return new Repo\ContactRepository($client, $hydrator);
    },
    Repo\DiseaseUnitRepositoryInterface::class => function ( Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator ) {
        return new Repo\DiseaseUnitRepository($apiAttribute, $hydrator);
    },
    Repo\RegistrationRepositoryInterface::class => function ( Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator ) {
        return new Repo\RegistrationRepository($apiAttribute, $hydrator);
    },
    Repo\AgreementRepositoryInterface::class => function ( Client $client, AttributeHydrator $hydrator ) {
        return new Repo\AgreementRepository($client, $hydrator);
    },
    Repo\SourceOfAdditionRepositoryInterface::class => function ( Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator ) {
        return new Repo\SourceOfAdditionRepository($apiAttribute, $hydrator);
    },
    Repo\ContactTypeRepositoryInterface::class => function ( Client $client, AttributeHydrator $hydrator ) {
        return new Repo\ContactTypeRepository($client, $hydrator);
    },
    Repo\ContactCategoryRepositoryInterface::class => function ( Client $client, AttributeHydrator $hydrator ) {
        return new Repo\ContactCategoryRepository($client, $hydrator);
    },
    Repo\ApiAttribute::class => function ( Client $client ) {
        return new   Repo\ApiAttribute($client);
    },
    Client::class => DI\factory(static function (Token $token ) {

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