<?php

namespace Looper\controllers;

use Looper\models\Status;
use Looper\models\Exercise;
use Core\forms\Field;
use Core\services\Http;
use Core\forms\FormValidator;
use Core\router\RouterManager;
use Core\controllers\AbstractController;

class ExerciseController extends AbstractController
{

    public function create()
    {
        $form = new FormValidator('exercise');
        $form->addField(['title' => new Field('title', 'string', true)]);

        if ($form->process() && $this->csrfValidator()) {
            $exercise = Exercise::make([
                'title' => $form->getFields()['title']->value,
            ]);
            if ($exercise->create()) return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->id]);
        }

        return Http::response('exercise/create', ['title' => Exercise::DEFAULTNAME], hasForm: true);
    }

    public function delete(int $id)
    {
        $exercise = Exercise::find($id);
        if (empty($exercise) || $exercise->getStatus() == Status::findBySlug('ANSW')) return Http::notFoundException();
        if (!$exercise->delete()) return Http::internalServerError();

        return Http::responseApi(['route' => RouterManager::getRouter()->getUrl('ManageExercise', [])]);
    }

    /**
     * Displays the answers given for an exercise
     *
     * @param integer $id
     * @return void
     */
    public function results(int $id)
    {
        $exercise = Exercise::find($id);
        if (empty($exercise)) return Http::notFoundException();

        return Http::response(
            'exercise/results',
            ['exercise' => $exercise, 'link' => RouterManager::getRouter()->getUrl('ResultExercise', ['idExercise' => $exercise->id]), 'title' => $exercise->title]
        );
    }

    /**
     * Change the status of an exercise
     *
     * @param integer $id
     * @param string $slug
     * @return void
     */
    public function status(int $id, string $slug)
    {
        $exercise = Exercise::find($id);
        $status = Status::findBySlug($slug);

        if (empty($exercise) || is_null($status)) return Http::notFoundException();

        if (empty($exercise->getQuestions()) || !$this->csrfValidator()) {
            return http::responseApi(['route' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $exercise->id])]);
        }

        $exercise->status_id = $status->id;

        if (!$exercise->update()) return Http::internalServerError();

        return http::responseApi(['route' => RouterManager::getRouter()->getUrl('ManageExercise', [])]);
    }
}
