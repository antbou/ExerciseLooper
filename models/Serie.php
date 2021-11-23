<?php

namespace Looper\models;


use Looper\core\models\Model;

class Serie extends Model
{
    private int $id;
    private ?\DateTime $date;
    private ?int $exercise_id;

    protected $table = 'series';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Serie
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): Serie
    {
        $this->date = $date;
        return $this;
    }

    public function getExerciseId(): ?int
    {
        return $this->exercise_id;
    }

    public function setExerciseId(int $id): Serie
    {
        $this->id = $id;
        return $this;
    }
}
