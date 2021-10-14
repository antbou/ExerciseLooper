<?php

use Looper\core\services\RouterManager;

require(dirname(dirname(__FILE__)) . '/vendor/autoload.php');
require(dirname(dirname(__FILE__)) . '/config/config.php');

$router = RouterManager::getRouter();
$router->process();
