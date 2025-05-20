<?php

namespace Ipresso\Config;

use Exception;

class Parameters
{
    public static function getPass()
    {
        return self::getEnv('IPRESSO_PASS');
    }

    public static function getLogin()
    {
        return self::getEnv('IPRESSO_LOGIN');
    }

    public static function getCostumerKey()
    {
        return self::getEnv('IPRESSO_CUSTOMER_KEY');
    }

    public static function getClientUrl()
    {
        return self::getEnv('IPRESSO_CLIENT_URL');
    }

    private static function getEnv(string $envName)
    {
        if (getenv($envName) === false) {
            throw new Exception('Env parameter ' . $envName . ' is not set');
        }

        return getenv($envName);
    }
}