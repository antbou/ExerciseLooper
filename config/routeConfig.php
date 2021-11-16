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
        'Method' => 'show'
    ],
    'DeleteQuestion' => [
        'URI' => '/exercises/:idExercise/fields/:idQuestion',
        'Controller' => 'QuestionController',
        'Method' => 'delete',
        'HttpMethod' => 'post'
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
    ],
    'ShowAllExercise' => [
        'URI' => '/exercises/all',
        'Controller' => 'ExerciseController',
        'Method' => 'status',
    ],
];
