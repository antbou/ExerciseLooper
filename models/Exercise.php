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

    public static function make(array $params)
    {
        $exercise = new Exercise();

        $exercise->id = (isset($params['id'])) ? $params['id'] : null;
        $exercise->title = $params['title'];
        $exercise->status = $params['status'];

        return $exercise;
    }

    public function getId(): int
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
        return $this;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function save(): bool
    {
        $attributes = ['id' => $this->id, 'title' => $this->title, 'status' => $this->status];

        return $this->saveObject($attributes);
    }
}
