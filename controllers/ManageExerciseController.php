<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\core\services\Http;
use Looper\core\models\Repository;
use Looper\core\controllers\AbstractController;
use Looper\models\Status;

class ManageExerciseController extends AbstractController
{
    public function show()
    {
        $buildedExercises = Repository::findAllWhere(Exercise::class, 'status_id', Status::findBySlug('UNDE')->id);
        $answeredExercises = Repository::findAllWhere(Exercise::class, 'status_id', Status::findBySlug('ANSW')->id);
        $closedExercises = Repository::findAllWhere(Exercise::class, 'status_id', Status::findBySlug('TERM')->id);
        return Http::response('manage/index', ['buildedExercises' => $buildedExercises, 'answeredExercises' => $answeredExercises, 'closedExercises' => $closedExercises]);
    }
}
