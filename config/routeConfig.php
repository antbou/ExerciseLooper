<?php

return [
    'HomePage' => [
        'URI' => '/',
        'Controller' => 'HomeController',
        'Method' => 'show'
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
        'Method' => 'show'
    ],
    'DeleteQuestion' => [
        'URI' => '/exercises/:idExercise/fields/:idQuestion',
        'Controller' => 'QuestionController',
        'Method' => 'delete'
    ],
];
