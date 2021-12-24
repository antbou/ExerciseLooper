<?php

namespace Core\traits;

trait Verification
{
    public function isInt($value): bool
    {
        return is_numeric($value);
    }

    public function isString($value): bool
    {
        return is_string($value);
    }

    public function isArray($value): bool
    {
        return is_array($value);
    }

    public function isBool($value): bool
    {
        return is_bool($value);
    }

    public function isFloat($value): bool
    {
        return is_float($value);
    }

    public function isMethodParamsValid(string $class, string $method, array $paramsValue): bool
    {
        $paramsType = new \ReflectionMethod($class, $method);

        // Checks if the received parameters match the hinting type of the called method
        foreach ($paramsType->getParameters() as $key => $param) {

            if (!isset($paramsValue[$key])) continue;

            $condition = 'is' . ucfirst((string)$param->gettype());

            if (!$this->$condition($paramsValue[$key])) return false;
        }

        return true;
    }
}
