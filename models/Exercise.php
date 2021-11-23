<?php

namespace Looper\models;

use Looper\core\models\Model;
use Looper\core\models\Repository;

class Exercise extends Model
{

    private ?int $id;
    private string $title;
    private int $status_id;

    protected $table = 'exercises';
    const DEFAULTNAME = 'New exercise';

    public static function make(array $params): Exercise
    {
        $exercise = new Exercise();
        $exercise->id = (isset($params['id'])) ? $params['id'] : null;
        $exercise->title = $params['title'];
        $exercise->status_id = (isset($params['status_id'])) ? $params['status_id'] : Repository::findAllWhere(Status::class, 'slug', 'UNDE')[0]->getId();

        return $exercise;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Exercise
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Exercise
    {
        $this->title = $title;
        return $this;
    }

    public function getStatusId(): int
    {
        return $this->status_id;
    }

    public function setStatusId(int $status_id): Exercise
    {
        $this->status_id = $status_id;
        return $this;
    }

    public function getPublicName(): string
    {
        $exerciseName = (empty($this->getTitle())) ? self::DEFAULTNAME : ((ctype_space($this->getTitle())) ? self::DEFAULTNAME : $this->getTitle());
        return $exerciseName;
    }

    public function getQuestions()
    {
        $query = "SELECT * FROM db_exerciselooper.questions WHERE questions.exercise_id = :id ORDER BY questions.id DESC";
        $params = ['id' => $this->id];

        return Repository::findCustom($query, $params, Question::class);
    }
}
