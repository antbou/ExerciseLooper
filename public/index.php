<?php
require_once('core/Render.php');

$variable = null;

// évite les messages d'erreurs type "warning" lorsque $_GET['page'] n'existe pas
if (!isset($_GET['page'])) {
    $_GET['page'] = "";
}


// obtient chaque arguments de l'URL
$settings = explode('/', $_GET['page']);

if ($settings[0] != "") {
    $controller = $settings[0];

    // définit l'action du controller exercises
    $action = isset($settings[1]) ? $settings[1] : 'home';

    switch ($action) {
        case 'answering':
            Render::render('answering/index');
            break;
        case 'new':
            Render::render('new/index');
            break;
        case 'home':
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
