<?php

declare(strict_types=1);

use App\Controller\RecommendationController;

return [
    '/' => [
        'controller' => RecommendationController::class,
        'method' => 'index'
    ],
    '/random/{number}' => [
        'controller' => RecommendationController::class,
        'method' => 'randomMovies'
    ],
    '/even-title-and-starts-with-char/{char}' => [
        'controller' => RecommendationController::class,
        'method' => 'moviesWithEvenTitleThatStartsWithChar'
    ],
    '/title-greater-than/{numberOfWords}' => [
        'controller' => RecommendationController::class,
        'method' => 'moviesWithTitleGreaterThanNumberOfWords'
    ],
];
