<?php

namespace Looper\models;

use Core\models\Model;
use Core\models\Repository;

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
        return Repository::find($this->question_id, Question::class);
    }
    public function getSerie(): Serie
    {
        return Repository::find($this->serie_id, Serie::class);
    }
}
