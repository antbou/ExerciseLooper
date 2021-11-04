<?php

namespace Looper\controllers;

use Looper\core\services\Http;
use Looper\core\controllers\AbstractController;
use Looper\core\models\Repository;
use Looper\models\Exercise;

class FieldController extends AbstractController
{
    public function create($id)
    {
        $this->checkNumeric($id);

        $exercise = Repository::find($id, Exercise::class);

        if (empty($exercise)) {
            Http::notFoundException();
        }

        Http::response('new/fields', ['exerciseName' => $exercise->getPublicName()]);
    }
}
