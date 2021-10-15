<?php

namespace Looper\core\services;

use Looper\core\services\Render;
use Looper\core\services\RouterManager;

class Http
{

    public static function notFoundException(): void
    {
        http_response_code(404);
        Render::render('errors/404');
    }

    public static function redirectToUrl(string $url): void
    {
        header("Location: $url");
        exit();
    }

    public static function redirectToRoute(string $route, array $variables = []): void
    {
        $router = RouterManager::getRouter();
        $url = $router->getUrl($route, $variables);

        header("Location: $url");
        exit();
    }

    public static function response(string $path, array $variables = [], int $responseCode = 200): void
    {
        http_response_code($responseCode);
        Render::render($path, $variables);
    }
}
