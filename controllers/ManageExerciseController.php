<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\core\services\Http;
use Looper\core\models\Repository;
use Looper\core\router\RouterManager;
use Looper\core\controllers\AbstractController;
use Looper\models\ExerciseState;
use Looper\models\Status;

class ManageExerciseController extends AbstractController
{

    public function show()
    {
        $buildedExercises = Repository::findAllWhere(Exercise::class, 'status_id', Repository::findAllWhere(Status::class, 'slug', 'UNDE')[0]->id);
        $answeredExercises = Repository::findAllWhere(Exercise::class, 'status_id', Repository::findAllWhere(Status::class, 'slug', 'ANSW')[0]->id);
        $closedExercises = Repository::findAllWhere(Exercise::class, 'status_id', Repository::findAllWhere(Status::class, 'slug', 'TERM')[0]->id);
        return Http::response('manage/index', ['buildedExercises' => $buildedExercises, 'answeredExercises' => $answeredExercises, 'closedExercises' => $closedExercises]);
    }
}
