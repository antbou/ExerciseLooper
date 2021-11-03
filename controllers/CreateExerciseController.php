<?php

namespace Looper\controllers;

use Looper\core\forms\Field;
use Looper\core\forms\FormValidator;
use Looper\core\controllers\AbstractController;
use Looper\core\models\Repository;
use Looper\core\services\Http;
use Looper\models\Exercise;

class CreateExerciseController extends AbstractController
{
    public function show()
    {

        echo "<pre>";
        var_dump(Repository::findAll(Exercise::class));
        echo "</pre>";
        die;

        Http::response('new/index', ['exerciseName' => 'New Exercise'], hasForm: true);
    }

    public function validate()
    {
        $form = new FormValidator('exercise');
        $form->addField(['title' => new Field('title', 'string', true)]);

        // In case of errors
        if (!$form->process() || !$this->csrfValidator()) {
            Http::redirectToRoute('CreateExercise', ['exerciseName' => 'New Exercise']);
        }

        $exercise = new Exercise([
            'title' => $form->getFields()['title']->value,
        ]);

        // if (!$exercise->save()) {
        //     Http::redirectToRoute('CreateExercise', ['exerciseName' => 'New Exercise']);
        // }

        // Http::redirectToRoute('AddFieldExercise', ['id' => $exercise->getId()]);
    }
}
