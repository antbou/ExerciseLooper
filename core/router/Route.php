<?php

namespace Looper\core\router;

use Looper\core\traits\Verification;
use Looper\core\traits\Exception as LooperException;

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
     * Permet de savoir si l'url donnée correspond à une route enregistrée
     * Si c'est le cas, les paramètres passés en URL seront sauvegardés dans $matches
     *
     * @param [type] $url = URL sur laquelle on essaie d'accéder
     * @return boolean
     */
    public function doesMatch(string $url): bool
    {
        // retire les / inutils
        $url = '/' . trim($url, '/');
        /**
         * Remplace : x par n'importe quel caractère qui n'est pas un /
         * On utilise # comme délimiteur car le / est déja utilisé
         */
        $path = preg_replace('#:([\w]+)#', '([^/*]+)', $this->path);


        /**
         * Création du regex
         * # comme délimiteur
         * i pour case-insensitive
         */
        $regex = "#^$path$#i";

        // si aucun résultat n'est trouvé
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        // supprime la 1ère valeur du tableau
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
     * Genère l'URL de la route avec les paramètres données à cette dernière
     *
     * @param array $params
     * @return void
     */
    public function generateUrl(array $params): string
    {
        $path = $this->path;
        if (!empty($params)) {
            foreach ($params as $slug => $value) {
                // Remplace l'identifiant du paramètre par sa valeur
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
            $this->showErrorIfDevMod($th);
            return false;
        }
    }
}
