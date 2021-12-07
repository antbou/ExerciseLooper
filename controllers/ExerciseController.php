<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\core\services\Http;
use Looper\core\models\Repository;
use Looper\core\router\RouterManager;
use Looper\core\controllers\AbstractController;
use Looper\models\Status;

class ExerciseController extends AbstractController
{

    public function status(int $id, string $slug)
    {
        $exercise = Repository::find($id, Exercise::class);
        $status = Repository::findWhere(Status::class, 'slug', $slug);
        if (empty($exercise) || is_null($status)) return Http::notFoundException();

        if (empty($exercise->getQuestions()) || !$this->csrfValidator()) {
            return http::responseApi(['route' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $exercise->id])]);
        }

        $exercise->status_id = $status->id;

        if (!$exercise->update()) return Http::internalServerError();

        return http::responseApi(['route' => RouterManager::getRouter()->getUrl('ManageExercise', [])]);
    }

    public function delete(int $id)
    {
        $exercise = Repository::find($id, Exercise::class);
        if (empty($exercise)) return Http::notFoundException();
        if (!$exercise->delete()) return Http::internalServerError();

        return Http::responseApi(['route' => RouterManager::getRouter()->getUrl('ManageExercise', [])]);
    }

    public function results(int $id)
    {
        $exercise = Repository::find($id, Exercise::class);
        if (empty($exercise)) return Http::notFoundException();

        return Http::response(
            'exercise/results',
            ['exercise' => $exercise, 'link' => RouterManager::getRouter()->getUrl('ResultExercise', ['idExercise' => $exercise->id])]
        );
    }
}
