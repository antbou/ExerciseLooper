<?php

namespace Looper\models;

use Looper\core\models\Model;
use Looper\core\models\Repository;

class Response extends Model
{

    private ?int $id;
    private string $value;
    private int $type;

    protected $table = 'responses';

    public static function make(array $params)
    {
        $response = new Response();
        $response->id = (isset($params['id'])) ? $params['id'] : null;
        $response->title = $params['value'];
        $response->status = (isset($params['type'])) ? $params['type'] : ExerciseState::UNDERCONSTRUCT;

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

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): Response
    {
        $this->type = $type;
        return $this;
    }
}
