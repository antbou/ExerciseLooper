<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\core\forms\Field;
use Looper\core\services\Http;
use Looper\core\forms\FormValidator;
use Looper\core\controllers\AbstractController;

class CreateExerciseController extends AbstractController
{
    public function show()
    {
        Http::response('new/index', ['title' => Exercise::DEFAULTNAME], hasForm: true);
    }

    public function validate()
    {
        $form = new FormValidator('exercise');
        $form->addField(['title' => new Field('title', 'string', true)]);

        // In case of errors
        if (!$form->process() || !$this->csrfValidator()) {
            Http::redirectToRoute('CreateExercise');
        }

        $exercise = Exercise::make([
            'title' => $form->getFields()['title']->value,
        ]);

        // In case of errors
        if (!$exercise->create()) {
            Http::redirectToRoute('CreateExercise');
        }

        Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->getId()]);
    }
}
