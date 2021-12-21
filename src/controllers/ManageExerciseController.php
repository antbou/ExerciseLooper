<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Core\services\Http;
use Core\controllers\AbstractController;
use Looper\models\Status;

class ManageExerciseController extends AbstractController
{
    public function show()
    {
        $buildedExercises = Exercise::allWhere('status_id', Status::findBySlug('UNDE')->id);
        $answeredExercises = Exercise::allWhere('status_id', Status::findBySlug('ANSW')->id);
        $closedExercises = Exercise::allWhere('status_id', Status::findBySlug('TERM')->id);
        return Http::response('manage/index', ['buildedExercises' => $buildedExercises, 'answeredExercises' => $answeredExercises, 'closedExercises' => $closedExercises], hasForm: true);
    }
}
