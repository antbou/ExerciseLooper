<?php

namespace Looper\models;

use ReflectionClass;

class QuestionState
{
    const SINGLE_LINE = 0;
    const SINGLE_LINE_LIST = 1;
    const MULTI_LINE  = 2;

    /**
     * return the name of a constant based on its value
     *
     * @param integer $val
     * @return void
     */
    public static function toString(int $val): string
    {
        $tmp = new ReflectionClass(get_called_class());
        $a = $tmp->getConstants();
        $b = array_flip($a);

        return strtolower($b[$val]);
    }

    /**
     * return the value of the constant via its alias
     *
     * @param string $alias
     * @return integer
     */
    public static function getConstValue(string $alias): int
    {
        return constant(self::class . '::' . strtoupper($alias));
    }
}
