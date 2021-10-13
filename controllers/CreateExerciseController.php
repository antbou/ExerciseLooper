<?php

namespace Looper\controllers;

use Looper\core\services\Field;
use Looper\core\services\FormValidator;
use Looper\core\services\Http;

class CreateExerciseController
{
    public function show()
    {
        Http::response('new/index', ['exerciseName' => 'New Exercise']);
    }

    public function validate()
    {
        $form = new FormValidator('exercise');

        $form->addField(new Field('title', 'int', true));

        $form->process();

        var_dump($form->getFields()[0]->error);
    }
}
