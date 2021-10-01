<?php

use Looper\core\services\Router;

require('../vendor/autoload.php');


$router = new Router($_SERVER['REQUEST_URI']);
$router->setConfig();

$router->process();
