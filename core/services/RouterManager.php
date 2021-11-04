<?php

namespace Looper\core\services;

use Looper\core\services\Router;

class RouterManager
{
    private static $instance = null;

    /**
     * Retourne une instance du router
     * 
     * @return PDO
     */
    public static function getRouter()
    {
        if (self::$instance === null) {
            $router = new Router($_SERVER['REQUEST_URI']);
            $router->setConfig();
            self::$instance = $router;
        }
        return self::$instance;
    }
}
