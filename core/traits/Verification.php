<?php

namespace Looper\core\traits;

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
}
