<?php

namespace Looper\controllers;

use Looper\core\services\Field;
use Looper\core\services\FormValidator;
use Looper\core\controllers\AbstractController;
use Looper\core\services\Http;
use Looper\models\Exercise;

class CreateExerciseController extends AbstractController
{
    public function show()
    {
        Http::response('new/index', ['exerciseName' => 'New Exercise'], hasForm: true);
    }

    public function validate()
    {
        $form = new FormValidator('exercise');
        $form->addField(['title' => new Field('title', 'string', false)]);

        // En cas d'erreur
        if (!$form->process() || !$this->csrfValidator()) {
            Http::redirectToRoute('CreateExercise', ['exerciseName' => 'New Exercise']);
        }

        $exercise = new Exercise();
        $exercise->setTitle($form->getFields()['title']->value);
        $exercise->setStatus(Exercise::UNDERCONSTRUCT);

        if (!$exercise->save()) {
            Http::redirectToRoute('CreateExercise', ['exerciseName' => 'New Exercise']);
        }
    }
}
