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
    'TestExercise' => [
        'URI' => '/exercises',
        'Controller' => 'CreateExerciseController',
        'Method' => 'csrfValidator'
    ]
];
