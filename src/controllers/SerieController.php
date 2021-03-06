<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Core\services\Http;
use Core\router\RouterManager;
use Core\controllers\AbstractController;

class SerieController extends AbstractController
{

    public function show(int $idExercise, int $idSerie)
    {
        $exercise = Exercise::find($idExercise);
        $serie = ($exercise) ? $exercise->getSerieById($idSerie) : null;
        if (empty($exercise) || empty($serie)) return Http::notFoundException();
        return Http::response(
            'serie/show',
            [
                'exercise' => $exercise,
                'serie' => $serie,
                'link' => RouterManager::getRouter()->getUrl('ResultExercise', ['idExercise' => $exercise->id])
            ]
        );
    }
}
