<?php

namespace Looper\core\models\traits;

trait Table
{
    public static function getShortName($classname): string
    {
        return strtolower((new \ReflectionClass($classname))->getShortName()) . 's';
    }
}
