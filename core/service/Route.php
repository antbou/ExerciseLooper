<?php

class Route
{

    private $path;
    private $controllerName;
    private $method;
    private $matches;

    public function __construct(string $path, string $controllerName, string $method)
    {
        $this->path = $path === '/' ? $path : trim($path, '/');
        $this->controllerName = $controllerName;
        $this->method = $method;
    }

    /**
     * Permet de capturer l'url avec les paramètre 
     * get('/posts/:slug-:id') par exemple
     **/
    public function match($url): bool
    {
        // retire les / inutils
        $url = $url === '/' ? $url : trim($url, '/');

        /**
         * Remplace :(x) par n'importe quelle caractère qui n'est pas un /
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

    public function generateUrl(array $params)
    {
        $path = $this->path;
        if (!empty($params)) {
            foreach ($params as $slug => $value) {
                $path = str_replace(":$slug", $value, $path);
            }
        }

        return $path;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }
    public function getMethod()
    {
        return $this->method;
    }
    public function getMatches()
    {
        return $this->matches;
    }
}
