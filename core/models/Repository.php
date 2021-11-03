<?php

namespace Looper\core\models;

use PDO;
use Looper\core\models\Database;

class Repository
{
    /**
     * Return a specific item
     *
     * @param integer $id
     * @return void
     */
    public static function find(int $id, string $classname): ?object
    {
        $table = strtolower((new \ReflectionClass($classname))->getShortName()) . 's';

        $item = Database::selectOne("select * from $table where id = :id", ['id' => $id]);

        return ($item) ? new $classname($item) : null;
    }

    public static function findAll(string $classname): array
    {
        $table = strtolower((new \ReflectionClass($classname))->getShortName()) . 's';

        return Database::selectMany("SELECT * FROM $table", [], $classname);
    }
}
