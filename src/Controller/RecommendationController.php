<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\NumberLowerThanOneException;
use App\Provider\MoviesProvider;
use App\Service\HtmlGenerator;
use App\Service\MovieRecommendationService;

readonly class RecommendationController
{
    public function __construct(
        private MoviesProvider $moviesProvider,
        private MovieRecommendationService $recommendationService,
        private HtmlGenerator $htmlGenerator,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function index(): void
    {
        $this->htmlGenerator->generateHtml($this->moviesProvider->getMovies());
    }

    /**
     * @throws \Exception
     */
    public function randomMovies(string $number): void
    {
        (new NumberLowerThanOneException())->execute($number);

        $movies = $this->recommendationService->getRandomMovies(
            movies: $this->moviesProvider->getMovies(),
            number: $number
        );

        $this->htmlGenerator->generateHtml($movies);
    }

    /**
     * @throws \Exception
     */
    public function moviesWithEvenTitleThatStartsWithChar(string $char): void
    {
        $movies = $this->recommendationService->getMoviesWithEvenTitleThatStartsWithChar(
            movies: $this->moviesProvider->getMovies(),
            char: $char
        );

        $this->htmlGenerator->generateHtml($movies);
    }

    /**
     * @throws \Exception
     */
    public function moviesWithTitleGreaterThanNumberOfWords(string $numberOfWords): void
    {
        $movies = $this->recommendationService->getMoviesWithTitleGreaterThanNumberOfWords(
            movies: $this->moviesProvider->getMovies(),
            numberOfWords: $numberOfWords
        );

        $this->htmlGenerator->generateHtml($movies);
    }
}
