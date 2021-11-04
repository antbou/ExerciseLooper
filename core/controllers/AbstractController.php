<?php

namespace Looper\core\controllers;

use ReflectionClass;
use Looper\core\services\Http;

abstract class AbstractController
{
    /**
     * Checks that the CSRF retrieved matches the CRSF of the session
     *
     * @return bool
     */
    public function csrfValidator()
    {
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

        if (isset($token) && $token == $_SESSION['token']) {
            return true;
        }
        return false;
    }

    /**
     * returns a 404 page if the id is not numeric
     *
     * @param [type] $id
     * @return void
     */
    public function checkNumeric($id): void
    {
        (is_numeric($id)) ?: Http::notFoundException();
    }

    /**
     * gets all the contstant in the given class
     *
     * @param string $classname
     * @param boolean $arrayKeyOnly
     * @return array
     */
    public function getConstants(string $classname, bool $arrayKeyOnly = false): array
    {
        $oClass = new ReflectionClass($classname);
        $result = $oClass->getConstants();
        return ($arrayKeyOnly) ? array_keys($result) : $result;
    }
}
