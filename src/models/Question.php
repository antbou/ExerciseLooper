<?php

namespace Looper\models;

use Looper\models\Response;
use Core\models\Model;

class Question extends Model
{
    public string $value;
    public int $exercise_id;
    public int $state_id;

    protected string $table = 'questions';

    public static function make(array $params): Question
    {
        $question = new question();
        $question->id = (isset($params['id'])) ? $params['id'] : null;
        $question->value = $params['value'];
        $question->state_id = $params['state_id'];
        $question->exercise_id = $params['exercise_id'];

        return $question;
    }

    public function getState(): State
    {
        return State::find($this->state_id);
    }
    public function getResponses(): array
    {
        return Response::allWhere('question_id', $this->id);
    }
}
