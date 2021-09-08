<?php
require_once('core/Render.php');

$variable = null;

if (!isset($_GET['page'])) {
    $_GET['page'] = "";
}

$params = explode('/', $_GET['page']);

if ($params[0] != "") {
    $controller = $params[0];

    $action = isset($params[1]) ? $params[1] : 'index';

    switch ($action) {
        case 'answering':
            Render::render('answering/index');
            break;
        case 'new':
            Render::render('new/index');
            break;
        case 'index':
            Render::render('exercises/index');
            break;
        default:
            http_response_code(404);
            include('templates/errors/404.html.php');
            die;
            break;
    }
} else {
    Render::render('home/index');
}
