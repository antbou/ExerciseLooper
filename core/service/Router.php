<?php

require_once('Route.php');
require_once('Http.php');

class Router
{
    private $url;
    private $routes = [];

    public function __construct(string $url = null)
    {
        $this->url = $url;
    }

    public function add(string $path, string $name, string $controllerName, string $method): Router
    {
        $route = new Route($path, $controllerName, $method);
        $this->routes += [$name => $route];
        return $this;
    }

    public function process()
    {
        /** @var Route */
        foreach ($this->routes as $name => $route) {

            if ($route->match($this->url)) {

                require_once('../controllers/' . $route->getControllerName() . '.php');

                $class = $route->getControllerName();
                $method = $route->getMethod();

                $controller = new $class;

                $params = $route->getMatches();

                // Permet d'appeler la méthode de l'object avec ou sans paramètres
                call_user_func_array([$controller, $method], $params);

                return;
            }
        }

        // Http::notFoundException();
    }

    public function getUrl(string $routeName, array $params)
    {
        // Si aucun nom de route ne correspond
        if (!array_key_exists($routeName, $this->routes)) {
            throw new Exception('No route matches this name');
        }

        /** @var Route */
        return $this->routes[$routeName]->generateUrl($params);
    }

    public function setConfig()
    {
        $routes = include('../config/routeConfig.php');

        foreach ($routes as $route => $params) {
            $this->add($params['URI'], $route, $params['Controller'], $params['Method']);
        }
    }
}
