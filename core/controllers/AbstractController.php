<?php

namespace Looper\core\controllers;

use ReflectionClass;
use Looper\core\services\Http;

abstract class AbstractController
{
    /**
     * Verifie que le CSRF récupèrer correspont au CRSF de la session
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

    public function getConstants(string $classname, bool $arrayKeyOnly = false)
    {
        $oClass = new ReflectionClass($classname);
        $result = $oClass->getConstants();
        return ($arrayKeyOnly) ? array_keys($result) : $result;
    }
}
