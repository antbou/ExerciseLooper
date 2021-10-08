<?php

namespace Looper\controllers;

use Looper\core\services\Http;

class CreateExerciseController
{
    public function show()
    {
        Http::response('new/index', ['exerciseName' => 'New Exercise']);
    }
}
