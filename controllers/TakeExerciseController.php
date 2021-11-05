<?php

namespace Looper\controllers;

use Looper\core\services\Field;
use Looper\core\services\FormValidator;
use Looper\core\controllers\AbstractController;
use Looper\core\models\Repository;
use Looper\core\services\Http;
use Looper\models\Exercise;

class TakeExerciseController extends AbstractController
{
    public function show()
    {
        $exercisesAnswered = Repository::findAllWhere(Exercise::class, 'status', '1');
        Http::response('take/index', ['exercisesAnswered' => $exercisesAnswered]);
    }
}
