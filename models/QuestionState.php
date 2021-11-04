<?php

namespace Looper\models;

use ReflectionClass;

class QuestionState
{
    const SINGLE_LINE_TEXT = 0;
    const SINGLE_LINE_LIST = 1;
    const MULTI_LINE_TEXT  = 2;

    /**
     * return the name of a constant based on its value
     *
     * @param integer $val
     * @return void
     */
    public static function toString(int $val)
    {
        $tmp = new ReflectionClass(get_called_class());
        $a = $tmp->getConstants();
        $b = array_flip($a);

        return strtolower($b[$val]);
    }
}
