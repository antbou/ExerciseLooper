<?php

namespace Looper\models;

use Looper\models\Response;
use Looper\core\models\Model;
use Looper\core\models\Repository;

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
        return Repository::find($this->state_id, State::class);
    }
    public function getResponses(): array
    {
        return Repository::findAllWhere(Response::class, 'question_id', $this->id);
    }
}
