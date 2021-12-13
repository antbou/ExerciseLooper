<?php

namespace Core\forms;

class Field
{
    public string $error;
    public string $name;
    public $type;
    public bool $canBeEmpty;
    public array $valueToVerify;
    public array $multi;

    public $value;

    public function __construct(string $name, $type, bool $canBeEmpty = false, array $valueToVerify = [], array $multi = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->canBeEmpty = $canBeEmpty;
        $this->valueToVerify = $valueToVerify;
        $this->multi = $multi;
    }
}
