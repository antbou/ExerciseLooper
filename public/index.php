<?php

use Looper\core\services\Router;

require(dirname(dirname(__FILE__)) . '/vendor/autoload.php');
require(dirname(dirname(__FILE__)) . '/config/config.php');
session_start();
$router = new Router($_SERVER['REQUEST_URI']);
$router->setConfig();

$router->process();
