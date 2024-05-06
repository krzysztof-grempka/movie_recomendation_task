<?php

declare(strict_types=1);

namespace App\Tests;

use App\Service\MovieRecommendationService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MovieRecommendationServiceTest extends TestCase
{
    private MovieRecommendationService $movieService;
    private array $movies = [
        "Spotlight",
        "Rocky",
        "Drive",
        "Zielona mila",
        "Forest Gump",
        "Milczenie owiec",
        "Czarnobyl",
        "Nędznicy",
        "Seksmisja",
        "Pachnidło",
        "Zjawa",
        "Kiler",
        "Siedem dusz",
    ];

    protected function setUp(): void
    {
        $this->movieService = new MovieRecommendationService();
    }

    public function testGetRandomMovies(): void
    {
        $randomMovies = $this->movieService->getRandomMovies(
            movies: $this->movies,
            number: '3'
        );

        $this->assertCount(3, $randomMovies);
    }
    public function testGetRandomMoviesWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->movieService->getRandomMovies(
            movies: $this->movies,
            number: 'd'
        );
    }

    public function testGetMoviesWithEvenTitleThatStartsWithLowerChar(): void
    {
        $filteredMovies = $this->movieService->getMoviesWithEvenTitleThatStartsWithChar(
            movies: $this->movies,
            char: 'n'
        );

        $this->assertCount(1, $filteredMovies);
        $this->assertEquals('Nędznicy', $filteredMovies[0]);
    }

    public function testGetMoviesWithEvenTitleThatStartsWithCapitalChar(): void
    {
        $filteredMovies = $this->movieService->getMoviesWithEvenTitleThatStartsWithChar(
            movies: $this->movies,
            char: 'N'
        );

        $this->assertCount(1, $filteredMovies);
        $this->assertEquals('Nędznicy', $filteredMovies[0]);
    }

    public function testGetMoviesWithTitleGreaterThanNumberOfWords(): void
    {
        $filteredMovies = $this->movieService->getMoviesWithTitleGreaterThanNumberOfWords(
            movies: $this->movies,
            numberOfWords: '1'
        );

        $expectedMovies = [
            "Zielona mila",
            "Forest Gump",
            "Milczenie owiec",
            "Siedem dusz",
        ];

        sort($filteredMovies);
        sort($expectedMovies);
        $this->assertCount(4, $filteredMovies);
        $this->assertSame($expectedMovies, $filteredMovies);
    }

    public function testGetMoviesWithTitleGreaterThanNumberOfWordsWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->movieService->getMoviesWithTitleGreaterThanNumberOfWords(
            movies: $this->movies,
            numberOfWords: 'f'
        );
    }
}
