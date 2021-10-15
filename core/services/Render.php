<?php

namespace Looper\core\services;

use Looper\core\services\RouterManager;

class Render
{
    /**
     * Permet de générer le rendu des pages
     *
     * @param string $path
     * @param array $variables
     * @return void
     */
    public static function render(string $path, array $variables = [], bool $hasForm = false)
    {
        $router = RouterManager::getRouter();

        if ($hasForm) {
            $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        }
        // Extrait les variables du tableau
        extract($variables);

        // Toutes les données suivantes seront sotckées dans un tampon temporaire 
        ob_start();
        require('../templates/' . $path . '.html.php');

        // récupère le contenu du tampon puis l'efface
        $pageContent = ob_get_clean();

        require('../templates/base.html.php');
    }
}
