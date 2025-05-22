<?php

use Ipresso\Container;
use Ipresso\Repository\ContactRepositoryInterface;

require_once __DIR__.'/../vendor/autoload.php';

$container = Container::get();

/** @var \Ipresso\Domain\Contact $c */
$c = $container->get(\Ipresso\Repository\ContactRepository::class)->getById(32866);

$c->getContactAttributeCollection()
    ->remove('lname')
    ->remove('fname')
    ->add(new \Ipresso\Domain\ContactAttributeString('fname', substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10)))
    ->add(new \Ipresso\Domain\ContactAttributeString('lname', substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10)));

$container->get(ContactRepositoryInterface::class)->update($c);
//dd($c,$container->get(\Ipresso\Repository\ContactRepository::class)->getAcivity($c));

//$a = $container->get(\Ipresso\Repository\ActivityRepository::class)->getAll();
$a = $container->get(\Ipresso\Repository\ActivityRepository::class)->getByKey('movie_contact');


if ($a instanceof \Ipresso\Domain\Activity) {

    /** @var \Ipresso\Domain\ActivityParameter $item */
    foreach ($a->getParameter() as $item) {
        switch ($item->getKey()) {
            case 'website':
                $item->setValue('Akademia Nutricia');
                break;
            case 'title':
                $item->setValue("Jakiś tytuł");
                break;
            case 'logging_in':
                $item->setValue(true);
                break;
            case 'business_line':
                $item->setValue("alergia");
                break;
            case 'article_type':
                $item->setValue('ClickMeeting');
                break;
            case 'tool_type':
                $item->setValue("video/nagrany webinar");
                break;
            case 'stage':
                $item->setValue("start");
                break;
        }
    }

} else {
    throw new \Exception('activity not found');
}



$container->get(\Ipresso\Repository\ContactRepository::class)->addAcivity($c, $a);


dump($a,$c);