<?php

namespace Looper\controllers;

use Looper\models\State;
use Looper\models\Status;
use Looper\models\Exercise;
use Looper\core\forms\Field;
use Looper\core\services\Http;
use Looper\core\models\Repository;
use Looper\core\forms\FormValidator;
use Looper\core\controllers\AbstractController;
use Looper\core\router\RouterManager;
use Looper\models\Response;
use Looper\models\Serie;

class TakeExerciseController extends AbstractController
{
    public function showAllAnswer()
    {
        $exercisesAnswered = Repository::findAllWhere(Exercise::class, 'status_id', Repository::findAllWhere(Status::class, 'slug', 'ANSW')[0]->id);
        return Http::response('take/index', ['exercisesAnswered' => $exercisesAnswered]);
    }

    public function showAnswer(int $id)
    {
        $states = array_column(Repository::findAll(State::class), null, 'slug');
        $focusExercise = Repository::find($id, Exercise::class);
        if (empty($focusExercise)) return Http::notFoundException();
        return Http::response(
            'take/answer',
            [
                'exercise' => $focusExercise,
                'states' => $states,
                'route' => RouterManager::getRouter()->getUrl('SaveAnswer', ['idExercise' => $focusExercise->id]),
                'title' => $focusExercise->title
            ],
            hasForm: true
        );
    }

    public function saveAnswer(int $id)
    {
        $exercise = Repository::find($id, Exercise::class);
        if (empty($exercise)) return Http::notFoundException();

        $form = new FormValidator('fulfillment');
        foreach ($exercise->getQuestions() as $key => $question) {
            $form->addField([$key => new Field("answers_attributes", 'string', true, multi: ['question' . $question->id])]);
        }

        if (!$form->process() || !$this->csrfValidator()) return Http::redirectToRoute('ShowAnswer', ['idExercise' => $exercise->id]);
        $serie = Serie::make([
            'date' => (new \DateTime('NOW', new \DateTimeZone("UTC")))->format('Y-m-d H:i:s'),
            'exercise_id' => $exercise->id
        ]);

        if (!$serie->create()) return Http::redirectToRoute('ShowAnswer', ['idExercise' => $exercise->id]);

        foreach ($exercise->getQuestions() as $key => $question) {
            $response = Response::make([
                'value' => $form->getFields()[$key]->value['question' . $question->id],
                'question_id' => $question->id,
                'serie_id' => $serie->id
            ]);
            if (!$response->create()) return Http::redirectToRoute('ShowAnswer', ['idExercise' => $exercise->id]);
        }

        return Http::redirectToRoute('ShowAnswerFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
    }

    public function showAnswerFilled(int $idExercise, int $idSerie)
    {
        $states = array_column(Repository::findAll(State::class), null, 'slug');
        $exercise = Repository::find($idExercise, Exercise::class);
        $serie = Repository::find($idSerie, Serie::class);
        if (empty($exercise) || empty($serie)) return Http::notFoundException();
        return Http::response('take/answer', [
            'exercise' => $exercise,
            'states' => $states,
            'edit' => true, 'serie' => $serie,
            'route' => RouterManager::getRouter()->getUrl('EditAnswer', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]),
            'title' => $exercise->title
        ], hasForm: true);
    }

    public function edit(int $idExercise, int $idSerie)
    {
        $exercise = Repository::find($idExercise, Exercise::class);
        $serie = Repository::find($idSerie, Serie::class);
        if (empty($exercise) || empty($serie)) return Http::notFoundException();

        $form = new FormValidator('fulfillment');
        foreach ($serie->getResponses() as $key => $response) {
            $form->addField([$key => new Field("answers_attributes", 'string', true, multi: ['response' . $response->id])]);
        }

        if (!$form->process() || !$this->csrfValidator()) {
            return Http::redirectToRoute('ShowAnswerFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
        }

        foreach ($serie->getResponses() as $key => $response) {
            $response->value = $form->getFields()[$key]->value['response' . $response->id];
            if (!$response->update()) return Http::redirectToRoute('ShowAnswerFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
        }
        return Http::redirectToRoute('ShowAnswerFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
    }
}
