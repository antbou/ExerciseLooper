<?php

namespace Core\traits;

use Core\models\Repository;

trait FindBySlug
{
    public static function findBySlug(string $slug): ?object
    {
        return self::where('slug', $slug);
    }
}
