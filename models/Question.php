<?php

namespace Looper\models;

use Looper\core\models\Model;

class Question extends Model
{
    private ?int $id;
    private string $value;
    private int $valueKind;
    private int $exercises_id;

    protected $table = 'questions';

    public static function make(array $params)
    {
        $question = new question();
        $question->id = (isset($params['id'])) ? $params['id'] : null;
        $question->value = $params['value'];
        $question->valueKind = $params['valueKind'];
        $question->exercises_id = $params['exercises_id'];

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

    public function getValueKind(): int
    {
        return $this->valueKind;
    }

    public function setValueKind(int $valueKind): Question
    {
        $this->valueKind = $valueKind;
        return $this;
    }

    public function getExercisesId(): int
    {
        return $this->exercises_id;
    }

    public function setExercisesId(int $exercises_id): Question
    {
        $this->exercises_id = $exercises_id;
        return $this;
    }
}
