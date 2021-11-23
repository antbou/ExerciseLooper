<?php

namespace Looper\models;

use Looper\core\models\Model;

class Status extends Model
{
    private int $id;
    private string $value;
    private string $slug;

    protected $table = 'status';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Status
    {
        $this->id = $id;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
