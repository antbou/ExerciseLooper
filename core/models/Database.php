<?php

namespace Looper\core\models;

use PDO;
use PDOException;

class Database
{

    private static $instance = null;

    /**
     * Retourne une connexion à la base de donnée
     * 
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        try {
            if (self::$instance === null) {
                require(APP_ROOT . '/.env.php');
                self::$instance = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSERNAME, DBPASSWORD);
            }
            return self::$instance;
        } catch (PDOException $e) {
            echo 'Échec de la connexion : ' . $e->getMessage();
            exit;
        }
    }
}
