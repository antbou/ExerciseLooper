<?php

namespace Looper\models;


use Looper\core\models\Model;
use Looper\core\models\Repository;

class Serie extends Model
{
    public string $date;
    public int $exercise_id;

    protected string $table = 'series';

    public static function make(array $params): Serie
    {
        $serie = new Serie();
        $serie->id = (isset($params['id'])) ? $params['id'] : null;
        $serie->date = $params['date'];
        $serie->exercise_id = $params['exercise_id'];
        return $serie;
    }

    public function getResponses(): array
    {
        return Repository::findAllWhere(Response::class, 'serie_id', $this->id);
    }
}
