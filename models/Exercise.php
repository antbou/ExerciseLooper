<?php

namespace Looper\models;

use Looper\core\models\Model;

class Exercise extends Model
{

    private ?int $id;
    private string $title;
    private int $status;

    protected $table = 'exercises';
    const DEFAULTNAME = 'New exercise';

    public static function make(array $params)
    {
        $exercise = new Exercise();
        $exercise->id = (isset($params['id'])) ? $params['id'] : null;
        $exercise->title = $params['title'];
        $exercise->status = (isset($params['status'])) ? $params['status'] : ExerciseState::UNDERCONSTRUCT;

        return $exercise;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Exercise
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Exercise
    {
        $this->title = $title;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Exercise
    {
        $this->status = $status;
        return $this;
    }

    public function getPublicName(): string
    {
        $exerciseName = (empty($this->getTitle())) ? self::DEFAULTNAME : ((ctype_space($this->getTitle())) ? self::DEFAULTNAME : $this->getTitle());
        return $exerciseName;
    }
}
