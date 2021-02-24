<?php
/**
 * Created by PhpStorm.
 * User: kkaczy
 * Date: 16.08.2018
 * Time: 12:27
 */

namespace Ipresso;

use Psr\Container\ContainerInterface;

class Container
{
    /** @var ContainerInterface */
    private static $container;

    public static function get(){

        if(!(self::$container instanceof ContainerInterface)){
            self::$container = (new \DI\ContainerBuilder())
                ->addDefinitions(__DIR__ . '/Config/service.php')
                ->build();
        }

        return  self::$container;
    }
}