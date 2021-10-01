<?php

namespace Looper\core\services;

use Looper\core\services\Router;

class Render
{
    /**
     * Permet de générer le rendu des pages
     *
     * @param string $path
     * @param array $variables
     * @return void
     */
    public static function render(string $path, array $variables = [])
    {
        $router = new Router();
        $router->setConfig();

        // Extrait les variables du tableau
        extract($variables);

        // Toues les données suivantes seront sotckées dans un tampon temporaire 
        ob_start();
        require('../templates/' . $path . '.html.php');

        // récupère le contenu du tampon puis l'efface
        $pageContent = ob_get_clean();

        require('../templates/base.html.php');
    }
}
