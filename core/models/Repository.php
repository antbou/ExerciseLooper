<?php

namespace Core\models;

use Core\traits\ClassToTable;

class Repository
{
    use ClassToTable;

    /**
     * Return a specific item
     *
     * @param integer $id
     * @return void
     */
    public static function find(int $id, string $classname): ?object
    {
        return Database::selectOne('select * from ' . self::getShortName($classname) . ' where id = :id', ['id' => $id], $classname);
    }

    public static function findAll(string $classname): array
    {
        return Database::selectMany('select * from ' . self::getShortName($classname), [], $classname);
    }

    public static function findAllWhere(string $fieldToCheck, string $ref, string $classname): array
    {
        return Database::selectMany('select * from ' . self::getShortName($classname) . ' WHERE ' . $fieldToCheck . ' = :' . $fieldToCheck, [$fieldToCheck => $ref], $classname);
    }

    public static function findWhere(string $fieldToCheck, string $ref, string $classname): ?object
    {
        return Database::selectOne('select * from ' . self::getShortName($classname) . ' WHERE ' . $fieldToCheck . ' = :' . $fieldToCheck, [$fieldToCheck => $ref], $classname);
    }

    public static function findCustom(string $query, array $params, string $className): array
    {
        return Database::selectMany($query, $params, $className);
    }
}
