<?php

namespace Looper\controllers;

use Looper\core\controllers\AbstractController;
use Looper\core\services\Http;

class CreateExerciseController extends AbstractController
{
    public function show()
    {
        Http::response(path: 'new/index', hasForm: true);
    }
}
