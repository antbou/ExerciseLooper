<?php

namespace Looper\models;

use Looper\core\models\Model;
use Looper\core\models\Repository;

class Response extends Model
{

    private ?int $id;
    private string $value;
    private int $question_id;
    private int $serie_id;

    protected $table = 'responses';

    public static function make(array $params)
    {
        $response = new Response();
        $response->id = (isset($params['id'])) ? $params['id'] : null;
        $response->value = $params['value'];
        $response->question_id = $params['question_id'];
        $response->serie_id = $params['serie_id'];
        return $response;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Response
    {
        $this->id = $id;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): Response
    {
        $this->value = $value;
        return $this;
    }

    public function getQuestionId(): int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): Response
    {
        $this->question_id = $question_id;
        return $this;
    }
    public function getSerieId(): int
    {
        return $this->serie_id;
    }

    public function setSerieId(int $serie_id): Response
    {
        $this->serie_id = $serie_id;
        return $this;
    }
}
