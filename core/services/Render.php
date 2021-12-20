<?php

namespace Core\services;

use Core\router\RouterManager;

class Render
{
    /**
     *  Allows to generate page rendering
     *
     * @param string $path
     * @param array $variables
     * @param boolean $hasForm
     * @return void
     */
    public static function render(string $path, array $variables = [], bool $hasForm = false)
    {
        $router = RouterManager::getRouter();

        if ($hasForm) {
            $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        }
        // Extract the variables from the table
        extract($variables);

        // All the following data will be stored in a temporary buffer 
        ob_start();
        require('../templates/' . $path . '.html.php');

        // retrieves the content of the buffer and deletes it
        $pageContent = ob_get_clean();

        require('../templates/base.html.php');
    }

    public static function renderApi(array $variables)
    {
        $variables = json_encode($variables, JSON_PRETTY_PRINT);

        require('../templates/api/index.html.php');
    }
}
