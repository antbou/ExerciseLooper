<?php

namespace Core\models;

use Core\traits\ClassToTable;

abstract class Repository
{
    use ClassToTable;

    public static function find(int $id): ?object
    {
        return Database::selectOne('select * from ' . self::getShortName(static::class) . ' where id = :id', ['id' => $id], static::class);
    }

    public static function all(): array
    {
        return Database::selectMany('select * from ' . self::getShortName(static::class), [], static::class);
    }

    public static function allWhere(string $fieldToCheck, string $ref): array
    {
        return Database::selectMany('select * from ' . self::getShortName(static::class) . ' WHERE ' . $fieldToCheck . ' = :' . $fieldToCheck, [$fieldToCheck => $ref], static::class);
    }

    public static function where(string $fieldToCheck, string $ref): ?object
    {
        return Database::selectOne('select * from ' . self::getShortName(static::class) . ' WHERE ' . $fieldToCheck . ' = :' . $fieldToCheck, [$fieldToCheck => $ref], static::class);
    }

    public static function custom(string $query, array $params): array
    {
        return Database::selectMany($query, $params, static::class);
    }
}
