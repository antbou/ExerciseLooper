<?php

namespace Looper\core\traits;

use Error;

trait Exception
{
    public function isDevEnvironment()
    {
        return (APP_ENV === APP_ENVIRONMENT_KIND[0]) ? true : false;
    }

    public function showErrorIfDevMod(Error $exception)
    {
        if ($this->isDevEnvironment()) {
            echo $exception->getMessage(); // for debug
            exit();
        }
    }
}
