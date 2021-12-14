<?php

namespace Looper\models;

use Core\models\Model;
use Core\models\Repository;

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
        return Response::allWhere('serie_id', $this->id);
    }
}
