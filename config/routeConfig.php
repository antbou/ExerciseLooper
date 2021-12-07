<?php

return [
    'HomePage' => [
        'URI' => '/',
        'Controller' => 'HomeController',
        'Method' => 'show',
    ],
    'CreateExercise' => [
        'URI' => '/exercises/new',
        'Controller' => 'CreateExerciseController',
        'Method' => 'show'
    ],
    'ValidateExercise' => [
        'URI' => '/exercises',
        'Controller' => 'CreateExerciseController',
        'Method' => 'validate'
    ],
    'CreateQuestion' => [
        'URI' => '/exercises/:idExercise/fields',
        'Controller' => 'QuestionController',
        'Method' => 'create'
    ],
    'TakeExercise' => [
        'URI' => '/exercises/answering',
        'Controller' => 'TakeExerciseController',
        'Method' => 'showAllAnswer'
    ],
    'ShowAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments/new',
        'Controller' => 'TakeExerciseController',
        'Method' => 'showAnswer'
    ],
    'SaveAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments',
        'Controller' => 'TakeExerciseController',
        'Method' => 'saveAnswer'
    ],
    'DeleteQuestion' => [
        'URI' => '/exercises/:idExercise/fields/:idQuestion',
        'Controller' => 'QuestionController',
        'Method' => 'delete',
        'HttpMethod' => 'delete'
    ],
    'EditQuestion' => [
        'URI' => '/exercises/:idExercise/fields/:idQuestion/edit',
        'Controller' => 'QuestionController',
        'Method' => 'edit',
    ],
    'StatusExercise' => [
        'URI' => '/exercises/:idExercise/status/:slug',
        'Controller' => 'ExerciseController',
        'Method' => 'status',
        'HttpMethod' => 'put'
    ],
    'ManageExercise' => [
        'URI' => '/exercises/all',
        'Controller' => 'ManageExerciseController',
        'Method' => 'show',
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
    'EditAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments/:idSerie',
        'Controller' => 'TakeExerciseController',
        'Method' => 'edit',
    ],
    'ShowAnswerFilled' => [
        'URI' => '/exercises/:idExercise/fulfillments/:idSerie/edit',
        'Controller' => 'TakeExerciseController',
        'Method' => 'showAnswerFilled',
    ],
    'ShowSeriesAnswer' => [
        'URI' => '/exercises/:idExercise/fulfillments/:idSerie/show',
        'Controller' => 'SerieController',
        'Method' => 'showAnswer',
    ],
    'ResultExercise' => [
        'URI' => '/exercises/:idExercise/results',
        'Controller' => 'ExerciseController',
        'Method' => 'results',
    ],
    'ResultsQuestion' => [
        'URI' => '/exercises/:idExercise/results/:idQuestion',
        'Controller' => 'QuestionController',
        'Method' => 'showResponses',
    ],

];
