<?php
require_once('../core/service/Router.php');

$router = new Router($_SERVER['REQUEST_URI']);
$router->setConfig();

$router->process();
