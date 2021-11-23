<?php

namespace Looper\core\services;

use Looper\core\services\Render;
use Looper\core\router\RouterManager;

class Http
{

    public static function notFoundException(): void
    {
        http_response_code(404);
        Render::render('errors/404');
        exit();
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

    public static function response(string $path, array $variables = [], int $responseCode = 200, bool $hasForm = false): void
    {
        http_response_code($responseCode);
        Render::render($path, $variables, $hasForm);
    }

    public static function responseApi(array $variables = [], int $responseCode = 200): void
    {
        http_response_code($responseCode);
        header('Content-Type: application/json; charset=utf-8');
        Render::renderApi($variables);
    }

    public static function internalServerError(): void
    {
        http_response_code(500);
        Render::render('errors/500');
        exit();
    }
}
