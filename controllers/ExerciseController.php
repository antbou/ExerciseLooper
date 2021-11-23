<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\core\services\Http;
use Looper\core\models\Repository;
use Looper\core\router\RouterManager;
use Looper\core\controllers\AbstractController;
use Looper\models\ExerciseState;
use Looper\models\Status;

class ExerciseController extends AbstractController
{

    public function status(int $id, string $slug)
    {
        $exercise = Repository::find($id, Exercise::class);
        if (empty($exercise) || $slug != 'answering') return Http::notFoundException();

        if (empty($exercise->getQuestions()) || !$this->csrfValidator()) {
            return http::responseApi(['route' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $exercise->getId()])]);
        }

        $exercise->setStatusId(Repository::findAllWhere(Status::class, 'slug', 'UNDE')[0]->getId());

        if (!$exercise->update()) return Http::internalServerError();

        return http::responseApi(['route' => RouterManager::getRouter()->getUrl('ShowAllExercise', [])]);
    }
}
