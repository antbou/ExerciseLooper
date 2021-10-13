<?php

namespace Looper\models;

use Looper\core\models\Model;

class Exercise extends Model
{

    private $id;
    private string $title;
    private int $status;
    protected $table = "exercises";

    const UNDERCONSTRUCT = 0;
    const ANSWERED = 1;
    const TERMINATE = 2;

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function save()
    {
        $attributes = ['id' => $this->id, 'title' => $this->title, 'status' => $this->status];

        $this->saveObject($attributes);
    }
}
