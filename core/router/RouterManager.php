<?php

namespace Core\router;

class RouterManager
{
    private static $instance = null;

    /**
     * Returns an instance of the router
     *
     * @return Router
     */
    public static function getRouter(): Router
    {
        if (self::$instance === null) {
            $router = new Router($_SERVER['REQUEST_URI']);
            $router->setConfig();
            self::$instance = $router;
        }
        return self::$instance;
    }
}
