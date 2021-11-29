<?php

namespace Looper\core\traits;

use Error;

trait Exception
{
    public function isDevEnvironment()
    {
        if (!defined('DBHOST') || !defined('CHARSET'))  require(APP_ROOT . '/.env.php');
        return (APP_ENV === APP_ENVIRONMENT_KIND[0]) ? true : false;
    }

    public function showErrorIfDevMod($exception)
    {
        if ($this->isDevEnvironment()) {
            echo $exception; // for debug
        }
    }
}
