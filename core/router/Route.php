<?php

namespace Core\router;


use Core\traits\Verification;
use Core\traits\Exception as LooperException;

class Route
{
    use Verification {
        isMethodParamsValid as isMethodParamsValidTrait;
    }
    use LooperException;

    private $path;
    private $controller;
    private $method;
    private $httpMethod;
    private $matches;

    public function __construct(string $path, string $className, string $method, ?string $httpMethod)
    {
        $this->path = '/' . trim($path, '/');
        $this->controller = "Looper\controllers\\$className";
        $this->method = $method;
        $this->httpMethod = $httpMethod;
    }

    /**
     * Allows to know if the given url corresponds to a registered route
     * If this is the case, the parameters passed in URL will be saved in $matches
     *
     * @param [type] $url = URL on which we try to access
     * @return boolean
     */
    public function doesMatch(string $url): bool
    {
        // remove the / useless
        $url = '/' . trim($url, '/');
        /**
         * Replace : x with any character that is not a /
         * We use # as delimiter because the / is already used
         */
        $path = preg_replace('#:([\w]+)#', '([^/*]+)', $this->path);


        /**
         * Creation of the regex
         * # as delimiter
         * i for case-insensitive
         */
        $regex = "#^$path$#i";

        // if no results are found
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        // deletes the 1st value of the table
        array_shift($matches);

        $this->matches = $matches;
        return true;
    }

    /**
     * Check if the http method indicated corresponds to the one received by the server
     *
     * @return boolean true if httpMethod not indicated or httpMethod matches with the http request's method
     */
    public function doesHttpMethodMatch(): bool
    {
        $method = ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method'])) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
        if (
            is_null($this->httpMethod) || strtoupper($this->httpMethod) == strtoupper($method)
        ) return true;
        return false;
    }

    /**
     * Generates the URL of the route with the parameters given to it
     *
     * @param array $params
     * @return void
     */
    public function generateUrl(array $params): string
    {
        $path = $this->path;
        if (!empty($params)) {
            foreach ($params as $slug => $value) {
                // Replaces the parameter identifier by its value
                $path = str_replace(":$slug", $value, $path);
            }
        }

        return $path;
    }

    public function isMethodParamsValid(): bool
    {
        return $this->isMethodParamsValidTrait($this->controller, $this->method, $this->matches);
    }

    public function call(): bool
    {
        try {
            // Calls the method of the object (controller) with or without parameters
            call_user_func_array([new $this->controller, $this->method], $this->matches);
            return true;
        } catch (\Throwable $th) {
            if (ob_get_contents()) ob_end_clean();
            $this->showErrorIfDevMod($th);
            return false;
        }
    }
}
