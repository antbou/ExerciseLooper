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
        Http::response('new/index', ['exerciseName' => 'New Exercise']);
    }

    public function validate()
    {
        $form = new FormValidator('exercise');
        $form->addField(['title' => new Field('title', 'string', true)]);

        if (!$form->process()) {
            Http::redirectToRoute('CreateExercise');
        }

        $exercise = new Exercise();
        $exercise->setTitle($form->getFields()['title']->value);
        $exercise->setStatus(Exercise::UNDERCONSTRUCT);

        if (!$exercise->save()) {
            Http::redirectToRoute('CreateExercise');
        }
        Http::response(path: 'new/index', hasForm: true);
    }
}
