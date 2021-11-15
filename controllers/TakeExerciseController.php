<?php

namespace Looper\controllers;

use Looper\core\services\Field;
use Looper\core\services\FormValidator;
use Looper\core\controllers\AbstractController;
use Looper\core\models\Repository;
use Looper\core\services\Http;
use Looper\models\Exercise;
use Looper\models\Question;
use Looper\models\QuestionState;

class TakeExerciseController extends AbstractController
{
    public function show()
    {
        $exercisesAnswered = Repository::findAllWhere(Exercise::class, 'status', '1');
        return Http::response('take/index', ['exercisesAnswered' => $exercisesAnswered]);
    }
    public function answeredExrcise($id)
    {

        $focusExercise = Repository::find($id, Exercise::class);
        if (empty($focusExercise)) {
            Http::notFoundException();
        }
        return Http::response('take/answer', ['focusExercise' => $focusExercise, 'questionState' => QuestionState::class], hasForm: true);
    }
}
