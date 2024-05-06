<?php

declare(strict_types=1);

use App\Service\HtmlGenerator;
use DI\Container;
use DI\ContainerBuilder;
use App\Controller\RecommendationController;
use App\Provider\MoviesProvider;
use App\Service\MovieRecommendationService;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    RecommendationController::class => function (Container $container) {
        return new RecommendationController(
            $container->get(MoviesProvider::class),
            $container->get(MovieRecommendationService::class),
            $container->get(HtmlGenerator::class)
        );
    },
    MoviesProvider::class => DI\autowire(),
    MovieRecommendationService::class => DI\autowire(),
    HtmlGenerator::class => DI\autowire(),
]);

try {
    return $containerBuilder->build();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
