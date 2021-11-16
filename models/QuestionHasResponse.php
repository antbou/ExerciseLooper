<?php

namespace Looper\models;

use DateTime;
use Looper\core\models\Model;
use Looper\core\models\Repository;

class QuestionHasResponse extends Model
{

    private ?int $id;
    private DateTime $date;
    private string $userAgent;
    private int $questions_id;
    private int $responses_id;

    protected $table = 'questionHasResponses';

    public static function make(array $params)
    {
        //TODO refactorisation : $response->id = $params['id'] ?? null;
        $questionHasResponse = new QuestionHasResponse();
        $questionHasResponse->id = (isset($params['id'])) ? $params['id'] : null;
        $questionHasResponse->date = $params['date'];
        $questionHasResponse->userAgent = $params['userAgent'];
        $questionHasResponse->questions_id = $params['questions_id'];
        $questionHasResponse->responses_id = $params['responses_id'];

        return $questionHasResponse;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): QuestionHasResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(string $date): QuestionHasResponse
    {
        $this->date = $date;
        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(int $userAgent): QuestionHasResponse
    {
        $this->userAgent = $userAgent;
        return $this;
    }
    public function getQuestionsid(): int
    {
        return $this->questions_id;
    }

    public function setQuestionsid(int $questions_id): QuestionHasResponse
    {
        $this->questions_id = $questions_id;
        return $this;
    }
    public function getResponsesid(): int
    {
        return $this->responses_id;
    }
    public function setResponsesid(int $responses_id): QuestionHasResponse
    {
        $this->responses_id = $responses_id;
        return $this;
    }
}
