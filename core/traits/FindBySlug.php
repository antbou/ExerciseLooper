<?php

namespace Core\traits;

use Core\models\Repository;

trait FindBySlug
{
    public static function findBySlug(string $slug): ?object
    {
        return Repository::findWhere(static::class, 'slug', $slug);
    }
}
