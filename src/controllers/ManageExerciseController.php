<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Core\services\Http;
use Core\models\Repository;
use Core\controllers\AbstractController;
use Looper\models\Status;

class ManageExerciseController extends AbstractController
{
    public function show()
    {
        $buildedExercises = Repository::findAllWhere('status_id', Status::findBySlug('UNDE')->id, Exercise::class);
        $answeredExercises = Repository::findAllWhere('status_id', Status::findBySlug('ANSW')->id, Exercise::class);
        $closedExercises = Repository::findAllWhere('status_id', Status::findBySlug('TERM')->id, Exercise::class);
        return Http::response('manage/index', ['buildedExercises' => $buildedExercises, 'answeredExercises' => $answeredExercises, 'closedExercises' => $closedExercises]);
    }
}
