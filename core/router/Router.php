<?php

namespace Core\router;


use Core\services\Http;
use Core\traits\Verification;
use Core\traits\Exception as LooperException;

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
     * Create the route and store it in a table
     *
     * @param string $path
     * @param string $name
     * @param string $controllerName
     * @param string $method
     * @param string|null $httpMethod
     * @return void
     */
    public function add(string $path, string $name, string $controllerName, string $method, ?string $httpMethod): void
    {
        $route = new Route($path, $controllerName, $method, $httpMethod);
        $this->routes += [$name => $route];
    }

    /**
     *  Allows to find and call a controller associated to a route
     *
     * @return mixed
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
     * Allows you to obtain the URL of a route based on its name
     *
     * @param string $routeName
     * @param array $params
     * @return string
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
     * Retrieves data from the route Config file
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
