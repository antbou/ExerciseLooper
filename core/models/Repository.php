<?php

namespace Looper\core\models;

use PDO;
use Looper\core\models\Database;

class Repository
{

    /**
     * Retourne un objet ou un tableau d'objet en fonction de la requête saisie
     *
     * @param string $query
     * @param array $params
     * @param string $className
     * @return void
     */
    public static function findCustom(string $query, array $params, string $className): array | object
    {
        $sth = Database::getPdo()->prepare($query);
        $sth->execute($params);
        $sth->setFetchMode(PDO::FETCH_CLASS, $className);
        $result = $sth->fetchAll();

        // Retourne un objet à la place d'un tableau d'objet si ce dernier ne contient qu'un objet.
        if (count($result) === 1) {
            $result = $result[0];
        }

        return $result;
    }


    /**
     * Method find
     * Permet de trouver un objet par son ID
     *
     * @param int $id
     * @param string $className
     *
     * @return object
     */
    public static function find(int $id, string $className): array | object
    {
        $query = 'select * from ' . strtolower((new \ReflectionClass($className))->getShortName()) . 's' . ' where id = :id';

        $result = self::findCustom($query, ['id' => $id], $className);

        return $result;
    }
}
