<?php

namespace Looper\controllers;

use Looper\models\Serie;
use Looper\models\Status;
use Looper\models\Exercise;
use Looper\core\forms\Field;
use Looper\core\services\Http;
use Looper\models\ExerciseState;
use Looper\core\models\Repository;
use Looper\core\forms\FormValidator;
use Looper\core\router\RouterManager;
use Looper\core\controllers\AbstractController;

class SerieController extends AbstractController
{

    public function showAnswer(int $idExercise, int $idSerie)
    {
        $exercise = Repository::find($idExercise, Exercise::class);
        $serie = Repository::find($idSerie, Serie::class);
        if (empty($exercise) || empty($serie)) return Http::notFoundException();
        return Http::response('serie/show', ['exercise' => $exercise, 'serie' => $serie]);
    }
}
