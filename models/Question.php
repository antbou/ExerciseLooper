<?php

namespace Looper\models;

use Looper\core\models\Model;

class Question extends Model
{
    private ?int $id;
    private string $value;
    private int $exercise_id;
    private int $state_id;

    protected $table = 'questions';

    public static function make(array $params): Question
    {
        $question = new question();
        $question->id = (isset($params['id'])) ? $params['id'] : null;
        $question->value = $params['value'];
        $question->state_id = $params['state_id'];
        $question->exercise_id = $params['exercise_id'];

        return $question;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Question
    {
        $this->id = $id;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): Question
    {
        $this->value = $value;
        return $this;
    }

    public function getStateId(): int
    {
        return $this->state_id;
    }

    public function setStateId(int $state_id): Question
    {
        $this->state_id = $state_id;
        return $this;
    }

    public function getExercisesId(): int
    {
        return $this->exercise_id;
    }

    public function setExercisesId(int $exercise_id): Question
    {
        $this->exercise_id = $exercise_id;
        return $this;
    }
}
