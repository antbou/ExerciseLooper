<?php

namespace Looper\models;

use Looper\core\models\Model;
use Looper\core\models\Repository;

class Response extends Model
{
    public string $value;
    public int $question_id;
    public int $serie_id;

    protected string $table = 'responses';

    public static function make(array $params)
    {
        $response = new Response();
        $response->id = (isset($params['id'])) ? $params['id'] : null;
        $response->value = $params['value'];
        $response->question_id = $params['question_id'];
        $response->serie_id = $params['serie_id'];
        return $response;
    }

    public function getQuestion()
    {
        return Repository::find($this->question_id, Question::class);
    }
}
