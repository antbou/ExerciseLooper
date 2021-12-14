<?php

namespace Looper\controllers;

use Looper\models\Exercise;
use Looper\models\Question;
use Core\forms\Field;
use Core\services\Http;
use Core\forms\FormValidator;
use Core\router\RouterManager;
use Core\controllers\AbstractController;
use Looper\models\State;
use Looper\models\Status;

class QuestionController extends AbstractController
{
    public function create(int $id)
    {
        $exercise = Exercise::find($id);

        if (empty($exercise) || ($exercise->getStatus() != Status::findBySlug('UNDE'))) return Http::notFoundException();

        $states = array_map(function ($o) {
            return $o->slug;
        }, State::all());

        $form = new FormValidator('field');
        $form
            ->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $states)]);

        if ($form->process() && $this->csrfValidator()) {
            $question = Question::make([
                'value' => $form->getFields()['value']->value,
                'state_id' => State::findBySlug($form->getFields()['valueKind']->value)->id,
                'exercise_id' => $exercise->id
            ]);
            if ($question->create()) return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->id]);
        }

        return Http::response('questions/new', [
            'exercise' => $exercise,
            'states' => State::all(),
            'link' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $exercise->id])
        ], hasForm: true);
    }

    public function delete(int $idExercise, int $idQuestion)
    {
        $exercise = Exercise::find($idExercise);
        $question = ($exercise) ? $exercise->getQuestionById($idQuestion) : null;

        if (empty($exercise) || ($exercise->getStatus() != Status::findBySlug('UNDE')) || empty($question)) return Http::notFoundException();

        $url = ['route' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $question->exercise_id])];

        if (!$this->csrfValidator()) return Http::responseApi($url);

        if (!$question->delete()) return Http::internalServerError();

        return Http::responseApi($url);
    }

    public function edit(int $idExercise, int $idQuestion)
    {
        $exercise = Exercise::find($idExercise);
        $question = ($exercise) ? $exercise->getQuestionById($idQuestion) : null;

        if (empty($exercise) || ($exercise->getStatus() != Status::findBySlug('UNDE')) || empty($question)) return Http::notFoundException();

        $states = array_map(function ($o) {
            return $o->slug;
        }, State::all());

        $form = new FormValidator('field');
        $form
            ->addField(['value' => new Field('label', 'string', true)])
            ->addField(['valueKind' => new Field('value_kind', 'string', false, valueToVerify: $states)]);

        if ($form->process() && $this->csrfValidator()) {
            $question->value = $form->getFields()['value']->value;
            $question->state_id = State::findBySlug($form->getFields()['valueKind']->value)->id;
            if ($question->update()) return Http::redirectToRoute('CreateQuestion', ['idExercise' => $exercise->id]);
        }

        return Http::response('questions/edit', [
            'exercise' => $exercise,
            'question' => $question,
            'states' => State::all(),
            'link' => RouterManager::getRouter()->getUrl('CreateQuestion', ['idExercise' => $exercise->id])
        ], hasForm: true);
    }

    /**
     * Display the answers obtained to a specific question
     *
     * @param integer $idExercise
     * @param integer $idQuestion
     * @return void
     */
    public function showAnswers(int $idExercise, int $idQuestion)
    {
        $exercise = Exercise::find($idExercise);
        $question = ($exercise) ? $exercise->getQuestionById($idQuestion) : null;

        if (empty($exercise) || empty($question)) return Http::notFoundException();
        return Http::response('questions/show', [
            'exercise' => $exercise, 'question' => $question,
            'link' => RouterManager::getRouter()->getUrl('ResultExercise', ['idExercise' => $exercise->id])
        ]);
    }
}
