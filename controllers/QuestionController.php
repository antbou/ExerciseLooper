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
use Looper\models\ExerciseState;

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
        $form
            ->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $this->getConstants(QuestionState::class, true))]);;


        if ($form->process() && $this->csrfValidator()) {

            $question = Question::make([
                'value' => $form->getFields()['value']->value,
                'valueKind' => QuestionState::getConstValue($form->getFields()['valueKind']->value),
                'exercises_id' => $exercise->getId()
            ]);

            if ($question->create()) {
                Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->getId()]);
            }
        }

        Http::response('new/question', ['exercise' => $exercise], hasForm: true);
    }
}
