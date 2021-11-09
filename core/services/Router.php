<?php

namespace Looper\core\services;

use Looper\core\services\Http;
use Looper\core\services\Route;
use Looper\core\traits\Verification;

class Router
{
    use Verification;

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
    public function add(string $path, string $name, string $controllerName, string $method): void
    {
        $route = new Route($path, $controllerName, $method);
        $this->routes += [$name => $route];
    }

    /**
     * Permet de trouver et d'appeler un contrôleur associé à une route
     *
     * @return boolean
     */
    public function process(): void
    {
        /** @var Route */
        foreach ($this->routes as $name => $route) {

            if ($route->doesMatch($this->url)) {

                $className = $route->getControllerName();
                $class = "Looper\controllers\\$className";
                $method = $route->getMethod();

                $controller = new $class;

                // récupère les paramètres de l'url depuis la route
                $params = $route->getMatches();

                $paramsType = new \ReflectionMethod($class, $method);

                $flag = true;

                // Checks if the received parameters match the hinting type of the called method
                foreach ($paramsType->getParameters() as $key => $param) {

                    if (!isset($params[$key])) continue;

                    $condition = 'is' . ucfirst((string)$param->gettype());
                    if (!$this->$condition($params[$key])) {
                        $flag = false;
                        break;
                    }
                }

                if ($flag) {
                    // Calls the method of the object (controller) with or without parameters
                    call_user_func_array([$controller, $method], $params);

                    return;
                }
            }
        }

        Http::notFoundException();
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
            $this->add($params['URI'], $route, $params['Controller'], $params['Method']);
        }
    }
}
