<?php

namespace Looper\core\router;

use Looper\core\services\Http;
use Looper\core\router\Route;
use Looper\core\traits\Verification;
use Looper\core\traits\Exception as LooperException;

class Router
{
    use Verification;
    use LooperException;

    private $url;
    private $routes = [];

    public function __construct(string $url = null)
    {
        $this->url = $url;
    }

    /**
     * Créé la route et la stocke dans un tableau
     *
     * @param string $path
     * @param string $name
     * @param string $controllerName
     * @param string $method
     * @return Router
     */
    public function add(string $path, string $name, string $controllerName, string $method, ?string $httpMethod): void
    {
        $route = new Route($path, $controllerName, $method, $httpMethod);
        $this->routes += [$name => $route];
    }

    /**
     * Permet de trouver et d'appeler un contrôleur associé à une route
     *
     * @return boolean
     */
    public function process(): mixed
    {
        foreach ($this->routes as $name => $route) {

            if ($route->doesMatch($this->url) && $route->isMethodParamsValid() && $route->doesHttpMethodMatch()) {

                $call = $route->call();
                if (!$call) return Http::internalServerError();
                return $call;
            }
        }

        return Http::notFoundException();
    }

    /**
     * Permet d'obtenir l'URL d'une route en fonction du nom de cette dernière
     *
     * @param string $routeName
     * @param array $params
     * @return Route
     */
    public function getUrl(string $routeName, array $params): string
    {
        // Si aucun nom de route ne correspond
        if (!array_key_exists($routeName, $this->routes)) {
            throw new \Exception('No route matches this name');
        }

        /** @var Route */
        return $this->routes[$routeName]->generateUrl($params);
    }

    /**
     * Récupère les données du fichier de configuration route Config
     *
     * @return void
     */
    public function setConfig(): void
    {
        $routes = include('../config/routeConfig.php');

        foreach ($routes as $route => $params) {
            $this->add(
                $params['URI'],
                $route,
                $params['Controller'],
                $params['Method'],
                (isset($params['HttpMethod'])) ? $params['HttpMethod'] : null
            );
        }
    }
}
