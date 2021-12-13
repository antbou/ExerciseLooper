<?php

namespace Core\models;

use PDO;
use PDOException;

class Database
{
    public static $host;

    private static $instance = null;

    /**
     * Returns a connection to the database
     * 
     * @return PDO
     */
    public static function getPdo(): PDO
    {

        try {
            if (self::$instance === null) {
                if (!defined('DBHOST') || !defined('CHARSET'))  require(APP_ROOT . '/.env.php');

                $host = (self::$host) ? self::$host : DBHOST;
                self::$instance = new PDO('mysql:host=' . $host . ';dbname=' . DBNAME . ';charset=' . CHARSET, DBUSERNAME, DBPASSWORD);
            }
            return self::$instance;
        } catch (PDOException $e) { // in case of error for the debug
            echo 'Connection failure : ' . $e->getMessage();
            exit;
        }
    }

    public static function selectMany(string $query, array $params, string $className): array
    {
        $sth = self::getPdo()->prepare($query);
        $sth->execute($params);

        $sth->setFetchMode(PDO::FETCH_CLASS, $className);
        $result = $sth->fetchAll();

        return $result;
    }

    public static function selectOne(string $query, array $params, $className): ?object
    {
        $sth = self::getPdo()->prepare($query);
        $sth->execute($params);
        $sth->setFetchMode(PDO::FETCH_CLASS, $className);

        $result = $sth->fetch();

        return ($result) ? $result : null;
    }

    public static function insert(string $query, array $params): int
    {
        $db = self::getPdo();
        $sth = $db->prepare($query);
        $sth->execute($params);

        $result = $db->lastInsertId();
        return $result;
    }

    public static function execute(string $query, array $params): bool
    {
        $db = self::getPdo();
        $sth = $db->prepare($query);
        return $sth->execute($params);
    }
}
