<?php

namespace Looper\models;

use Looper\models\Status;
use Core\models\Model;
use Core\models\Database;

class Exercise extends Model
{

    public string $title;
    public int $status_id;

    protected string $table = 'exercises';
    const DEFAULTNAME = 'New exercise';

    public static function make(array $params): Exercise
    {
        $exercise = new Exercise();
        $exercise->id = (isset($params['id'])) ? $params['id'] : null;
        $exercise->title = $params['title'];
        $exercise->status_id = (isset($params['status_id'])) ? $params['status_id'] : Status::findBySlug('UNDE')->id;

        return $exercise;
    }

    public function getPublicName(): string
    {
        $exerciseName = (empty($this->title)) ? self::DEFAULTNAME : ((ctype_space($this->title)) ? self::DEFAULTNAME : $this->title);
        return $exerciseName;
    }

    public function getQuestions(): array
    {
        $query = 'SELECT * FROM db_exerciselooper.questions WHERE questions.exercise_id = :id ORDER BY questions.id DESC';
        $params = ['id' => $this->id];

        return Question::custom($query, $params);
    }

    public function getSeries(): array
    {
        return Serie::allWhere('exercise_id', $this->id);
    }

    public function getStatus(): Status
    {
        return Status::find($this->status_id);
    }

    public function getQuestionById(int $id): ?Question
    {
        $table = self::getShortName(Question::class);
        return Database::selectOne("SELECT {$table}.* FROM {$table} WHERE {$table}.id = :idQuestion AND {$table}.exercise_id = :idExercise", ['idExercise' => $this->id, 'idQuestion' => $id], Question::class);
    }

    public function getSerieById(int $id): ?Serie
    {
        $table = self::getShortName(Serie::class);
        return Database::selectOne("SELECT {$table}.* FROM {$table} WHERE {$table}.id = :idSerie AND {$table}.exercise_id = :idExercise", ['idExercise' => $this->id, 'idSerie' => $id], Serie::class);
    }
}
