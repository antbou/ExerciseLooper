<?php

use Looper\core\router\RouterManager;

require(dirname(dirname(__FILE__)) . '/vendor/autoload.php');
require(dirname(dirname(__FILE__)) . '/config/config.php');

session_start();

$router = RouterManager::getRouter();
$router->process();
