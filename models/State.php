<?php

namespace Looper\models;

use Looper\core\models\Model;

class State extends Model
{
    private int $id;
    private string $name;
    private string $slug;

    protected $table = 'status';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): State
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
