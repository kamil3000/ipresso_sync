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
    DomianObjectFactory::class => fn() => new DomianObjectFactory(),
    ConnactionContact::class => fn(Correspondent $correspondent) => new ConnactionContact($correspondent),
    Correspondent::class => fn(Client $client) => new Correspondent($client),
    ContactValidator::class => fn() => new ContactValidator(),
    ApiAttributeValidator::class => fn(Repo\ApiAttribute $apiAttribute) => new ApiAttributeValidator($apiAttribute),
    Authentication::class => fn(Token $token) => new Authentication($token),
    AttributeHydrator::class => fn() => new AttributeHydrator(),
    ContactHydrator::class => static fn(Repo\AgreementRepositoryInterface $agreementRepository, Repo\ContactCategoryRepositoryInterface $contactCategoryRepository, Repo\ContactTypeRepositoryInterface $contactTypeRepositoryInterface, Repo\AttributeOptionRepository $attributeOptionRepository, Repo\ApiAttribute $apiAttribute) => new ContactHydrator($agreementRepository, $contactCategoryRepository,$contactTypeRepositoryInterface, $attributeOptionRepository, $apiAttribute),
    Repo\ActivityRepository::class => fn(Client $client, DomianObjectFactory $hydrator) => new Repo\ActivityRepository($client,$hydrator),
    Repo\TagRepository::class => fn(Client $client, DomianObjectFactory $hydrator) => new Repo\TagRepository($client, $hydrator),
    Repo\ContactRepositoryInterface::class => fn(Client $client, ContactHydrator $hydrator) => new Repo\ContactRepository($client, $hydrator),
    Repo\AttributeOptionRepositoryInterface::class => fn(Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator) => new Repo\AttributeOptionRepository($apiAttribute, $hydrator),
    Repo\RegistrationRepositoryInterface::class => fn(Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator) => new Repo\RegistrationRepository($apiAttribute, $hydrator),
    Repo\AgreementRepositoryInterface::class => fn(Client $client, AttributeHydrator $hydrator) => new Repo\AgreementRepository($client, $hydrator),
    Repo\SourceOfAdditionRepositoryInterface::class => fn(Repo\ApiAttribute $apiAttribute, AttributeHydrator $hydrator) => new Repo\SourceOfAdditionRepository($apiAttribute, $hydrator),
    Repo\ContactTypeRepositoryInterface::class => fn(Client $client, AttributeHydrator $hydrator) => new Repo\ContactTypeRepository($client, $hydrator),
    Repo\ContactCategoryRepositoryInterface::class => fn(Client $client, AttributeHydrator $hydrator) => new Repo\ContactCategoryRepository($client, $hydrator),
    Repo\ApiAttribute::class => fn(Client $client) => new   Repo\ApiAttribute($client),
    Client::class => DI\factory(static fn(Token $token) => new Client([
        'timeout' => 5.0,
        'base_uri' => Parameters::getClientUrl(),
        'verify' => false,
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'IPRESSO_TOKEN' => $token->getToken(),
            'User-Agent' => 'iPresso'
        ]])),
    Token::class => fn() => new Token(),
];