<?php

namespace Looper\controllers;

use Looper\models\State;
use Looper\models\Status;
use Looper\models\Exercise;
use Core\forms\Field;
use Core\services\Http;
use Core\forms\FormValidator;
use Core\controllers\AbstractController;
use Core\router\RouterManager;
use Looper\models\Response;
use Looper\models\Serie;

class TakeExerciseController extends AbstractController
{
    /**
     * Displays the list of the different exercises available that are ready to be answered
     *
     * @return void
     */
    public function showExercises()
    {
        $exercisesAnswered = Exercise::allWhere('status_id', Status::findBySlug('ANSW')->id);
        return Http::response('take/index', ['exercisesAnswered' => $exercisesAnswered]);
    }

    /**
     * Displays questions from a specific exercise
     *
     * @param integer $id
     * @return void
     */
    public function showQuestions(int $id)
    {
        $states = array_column(State::all(State::class), null, 'slug');
        $exercise = Exercise::find($id);
        if (empty($exercise) || $exercise->getStatus() != Status::findBySlug('ANSW')) return Http::notFoundException();
        return Http::response(
            'take/answer',
            [
                'exercise' => $exercise,
                'states' => $states,
                'route' => RouterManager::getRouter()->getUrl('SaveAnswer', ['idExercise' => $exercise->id]),
                'title' => $exercise->title
            ],
            hasForm: true
        );
    }

    /**
     * Save the answers then redirected to the edit page
     *
     * @param integer $id
     * @return void
     */
    public function createAnswers(int $id)
    {
        $exercise = Exercise::find($id);
        if (empty($exercise) || $exercise->getStatus() != Status::findBySlug('ANSW')) return Http::notFoundException();

        $form = new FormValidator('fulfillment');
        foreach ($exercise->getQuestions() as $key => $question) {
            $form->addField([$key => new Field("answers_attributes", 'string', true, multi: ['question' . $question->id])]);
        }

        if (!$form->process() || !$this->csrfValidator()) return Http::redirectToRoute('showQuestions', ['idExercise' => $exercise->id]);

        $serie = Serie::make([
            'date' => (new \DateTime('NOW', new \DateTimeZone("UTC")))->format('Y-m-d H:i:s'),
            'exercise_id' => $exercise->id
        ]);

        if (!$serie->create()) return Http::redirectToRoute('showQuestions', ['idExercise' => $exercise->id]);

        foreach ($exercise->getQuestions() as $key => $question) {
            $response = Response::make([
                'value' => $form->getFields()[$key]->value['question' . $question->id],
                'question_id' => $question->id,
                'serie_id' => $serie->id
            ]);
            if (!$response->create()) return Http::redirectToRoute('showQuestions', ['idExercise' => $exercise->id]);
        }

        return Http::redirectToRoute('ShowAnswersFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
    }

    /**
     * Modify the results of the answers then redirected to the edit page
     *
     * @param integer $idExercise
     * @param integer $idSerie
     * @return void
     */
    public function edit(int $idExercise, int $idSerie)
    {
        $exercise = Exercise::find($idExercise);
        $serie = ($exercise) ? $exercise->getSerieById($idSerie) : null;
        if (empty($exercise) || $exercise->getStatus() != Status::findBySlug('ANSW') || empty($serie)) return Http::notFoundException();

        $form = new FormValidator('fulfillment');
        foreach ($serie->getResponses() as $key => $response) {
            $form->addField([$key => new Field("answers_attributes", 'string', true, multi: ['response' . $response->id])]);
        }

        if (!$form->process() || !$this->csrfValidator()) {
            return Http::redirectToRoute('ShowAnswersFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
        }

        foreach ($serie->getResponses() as $key => $response) {
            $response->value = $form->getFields()[$key]->value['response' . $response->id];
            if (!$response->update()) return Http::redirectToRoute('ShowAnswersFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
        }
        return Http::redirectToRoute('ShowAnswersFilled', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]);
    }

    /**
     * Displays the content of the answers to the questions of an exercise
     *
     * @param integer $idExercise
     * @param integer $idSerie
     * @return void
     */
    public function showAnswersFilled(int $idExercise, int $idSerie)
    {
        $states = array_column(State::all(), null, 'slug');
        $exercise = Exercise::find($idExercise);
        $serie = ($exercise) ? $exercise->getSerieById($idSerie) : null;
        if (empty($exercise) || empty($serie)) return Http::notFoundException();
        return Http::response('take/answer', [
            'exercise' => $exercise,
            'states' => $states,
            'edit' => true, 'serie' => $serie,
            'route' => RouterManager::getRouter()->getUrl('EditAnswer', ['idExercise' => $exercise->id, 'idSerie' => $serie->id]),
            'title' => $exercise->title
        ], hasForm: true);
    }
}
