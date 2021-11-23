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
use Looper\models\State;

class QuestionController extends AbstractController
{
    public function create($id)
    {
        $this->checkNumeric($id);

        $exercise = Repository::find($id, Exercise::class);

        if (empty($exercise)) {
            return Http::notFoundException();
        }

        $states = array_map(function ($o) {
            return strtoupper($o->getName());
        }, Repository::findAll(State::class));

        $form = new FormValidator('field');
        $form
            ->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $states)]);;

        // DO TO use slug for the list (POST)
        if ($form->process() && $this->csrfValidator()) {

            $question = Question::make([
                'value' => $form->getFields()['value']->value,
                'state_id' => Repository::findAllWhere(State::class, 'name', $form->getFields()['valueKind']->value)[0]->getId(),
                'exercise_id' => $exercise->getId()
            ]);

            if ($question->create()) {
                return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->getId()]);
            }
        }

        return Http::response('new/question', ['exercise' => $exercise], hasForm: true);
    }
}
