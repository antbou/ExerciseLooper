<?php

require_once('Render.php');

class Http
{
    public static function notFoundException(): void
    {
        http_response_code(404);
        Render::render('errors/404');
    }

    public static function redirect(string $url): void
    {
        http_response_code(301);
        header("Location: $url");
        exit();
    }

    public static function response(string $path, array $variables = [], int $responseCode = 200): void
    {
        http_response_code($responseCode);
        Render::render($path, $variables);
    }
}
