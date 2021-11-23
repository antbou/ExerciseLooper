<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\models\Question;
use Looper\core\forms\Field;
use Looper\core\services\Http;
use Looper\models\QuestionState;
use Looper\core\models\Repository;
use Looper\core\forms\FormValidator;
use Looper\core\router\RouterManager;
use Looper\core\controllers\AbstractController;
use Looper\models\State;

class QuestionController extends AbstractController
{
    public function create(int $id)
    {
        $exercise = Repository::find($id, Exercise::class);

        if (empty($exercise)) return Http::notFoundException();

        $states = array_map(function ($o) {
            return $o->getSlug();
        }, Repository::findAll(State::class));

        $form = new FormValidator('field');
        $form
            ->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $states)]);

        if ($form->process() && $this->csrfValidator()) {
            $question = Question::make([
                'value' => $form->getFields()['value']->value,
                'state_id' => Repository::findAllWhere(State::class, 'slug', $form->getFields()['valueKind']->value)[0]->getId(),
                'exercise_id' => $exercise->getId()
            ]);

            if ($question->create()) return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->getId()]);
        }

        return Http::response('questions/new', ['exercise' => $exercise, 'states' => Repository::findAll(state::class)], hasForm: true);
    }

    public function delete(int $idExercise, int $idQuestion)
    {
        $question = Repository::find($idQuestion, Question::class);

        if (empty($question)) return Http::notFoundException();

        $url = ['route' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $question->getExercisesId()])];

        if (!$this->csrfValidator()) return Http::responseApi($url);

        if (!$question->delete()) return Http::internalServerError();

        return Http::responseApi($url);
    }

    public function edit(int $idExercise, int $idQuestion)
    {
        $exercise = Repository::find($idExercise, Exercise::class);
        $question = Repository::find($idQuestion, Question::class);

        if (empty($exercise) || empty($question)) return Http::notFoundException();

        $states = array_map(function ($o) {
            return strtoupper($o->getName());
        }, Repository::findAll(State::class));

        $form = new FormValidator('field');
        $form
            ->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $states)]);

        if ($form->process() && $this->csrfValidator()) {
            $question->setValue($form->getFields()['value']->value);
            $question->setStateId(Repository::findAllWhere(State::class, 'slug', $form->getFields()['valueKind']->value)[0]->getId());
            if ($question->update()) return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->getId()]);
        }

        return Http::response('questions/edit', ['exercise' => $exercise, 'question' => $question, 'questionState' => QuestionState::class], hasForm: true);
    }
}
