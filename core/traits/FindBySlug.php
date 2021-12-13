<?php

namespace Looper\core\traits;


use Looper\core\models\Repository;

trait FindBySlug
{
    public static function findBySlug(string $slug): ?object
    {
        return Repository::findWhere(static::class, 'slug', $slug);
    }
}
