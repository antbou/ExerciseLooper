<?php

namespace Looper\models;

use Core\models\Model;

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

    public function getQuestion(): Question
    {
        return Question::find($this->question_id);
    }
    public function getSerie(): Serie
    {
        return Serie::find($this->serie_id);
    }
}
