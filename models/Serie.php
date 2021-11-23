<?php

namespace Looper\models;


use Looper\core\models\Model;

class Serie extends Model
{
    private int $id;
    private ?\DateTime $date;
    private ?int $exercise_id;

    protected $table = 'series';

    public static function make(array $params): Serie
    {
        $serie = new Serie();
        $serie->id = (isset($params['id'])) ? $params['id'] : null;
        $serie->date = $params['date'];
        $serie->exercise_id = $params['exercise_id'];
        return $serie;
    }


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
