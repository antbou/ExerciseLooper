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
    public function create(int $id)
    {
        $exercise = Repository::find($id, Exercise::class);

        if (empty($exercise)) return Http::notFoundException();

        $form = new FormValidator('field');
        $form->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $this->getConstants(QuestionState::class, true))]);

        if ($form->process() && $this->csrfValidator()) {
            $question = Question::make([
                'value' => $form->getFields()['value']->value,
                'valueKind' => QuestionState::getConstValue($form->getFields()['valueKind']->value),
                'exercises_id' => $exercise->getId()
            ]);

            if ($question->create()) return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->getId()]);
        }

        return Http::response('questions/new', ['exercise' => $exercise], hasForm: true);
    }

    public function delete(int $idExercise, int $idQuestion): bool
    {
        if ($this->csrfValidator() && $_POST['_method'] === 'delete') {
            $question = Repository::find($idQuestion, Question::class);
            $question->delete();
        }

        return http_response_code(200);
    }

    public function edit(int $idExercise, int $idQuestion)
    {
        return Http::response('questions/edit', ['exercise' => $idExercise], hasForm: true);
    }
}
