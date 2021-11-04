<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\models\Question;
use Looper\core\forms\Field;
use Looper\core\services\Http;
use Looper\models\QuestionState;
use Looper\core\models\Repository;
use Looper\core\forms\FormValidator;
use Looper\core\controllers\AbstractController;

class QuestionController extends AbstractController
{
    public function create($id)
    {
        $this->checkNumeric($id);

        $exercise = Repository::find($id, Exercise::class);

        if (empty($exercise)) {
            Http::notFoundException();
        }

        $form = new FormValidator('field');
        $form->addField(['label' => new Field('label', 'string', true)]);
        $form->addField(['value_kind' => new Field('value_kind', 'string', false)]);



        Http::response('new/question', ['exercise' => $exercise], hasForm: true);
    }
}
