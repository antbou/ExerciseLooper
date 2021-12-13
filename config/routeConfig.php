<?php

return [
    'HomePage' => [
        'URI' => '/',
        'Controller' => 'HomeController',
        'Method' => 'show',
    ],
    'CreateExercise' => [
        'URI' => '/exercises/new',
        'Controller' => 'ExerciseController',
        'Method' => 'create'
    ],
    'EditExercise' => [
        'URI' => '/exercises/:idExercise/edit',
        'Controller' => 'ExerciseController',
        'Method' => 'edit',
    ],
    'DeleteExercise' => [
        'URI' => '/exercises/:idExercise/delete',
        'Controller' => 'ExerciseController',
        'Method' => 'delete',
    ],
    'StatusExercise' => [
        'URI' => '/exercises/:idExercise/status/:slug',
        'Controller' => 'ExerciseController',
        'Method' => 'status',
        'HttpMethod' => 'put'
    ],
    'ResultExercise' => [
        'URI' => '/exercises/:idExercise/results',
        'Controller' => 'ExerciseController',
        'Method' => 'results',
    ],
    'CreateQuestion' => [
        'URI' => '/exercises/:idExercise/fields',
        'Controller' => 'QuestionController',
        'Method' => 'create'
    ],
    'EditQuestion' => [
        'URI' => '/exercises/:idExercise/fields/:idQuestion/edit',
        'Controller' => 'QuestionController',
        'Method' => 'edit',
    ],
    'DeleteQuestion' => [
        'URI' => '/exercises/:idExercise/fields/:idQuestion',
        'Controller' => 'QuestionController',
        'Method' => 'delete',
        'HttpMethod' => 'delete'
    ],
    'ResultsQuestion' => [
        'URI' => '/exercises/:idExercise/results/:idQuestion',
        'Controller' => 'QuestionController',
        'Method' => 'showAnswers',
    ],
    'TakeExercise' => [
        'URI' => '/exercises/answering',
        'Controller' => 'TakeExerciseController',
        'Method' => 'showExercises'
    ],
    'showQuestions' => [
        'URI' => '/exercises/:idExercise/fulfillments/new',
        'Controller' => 'TakeExerciseController',
        'Method' => 'showQuestions'
    ],
    'SaveAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments',
        'Controller' => 'TakeExerciseController',
        'Method' => 'saveAnswer'
    ],
    'EditAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments/:idSerie',
        'Controller' => 'TakeExerciseController',
        'Method' => 'edit',
    ],
    'ShowAnswersFilled' => [
        'URI' => '/exercises/:idExercise/fulfillments/:idSerie/edit',
        'Controller' => 'TakeExerciseController',
        'Method' => 'showAnswersFilled',
    ],
    'ManageExercise' => [
        'URI' => '/exercises',
        'Controller' => 'ManageExerciseController',
        'Method' => 'show',
    ],
    'ShowSeriesAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments/:idSerie/show',
        'Controller' => 'SerieController',
        'Method' => 'show',
    ],
];
