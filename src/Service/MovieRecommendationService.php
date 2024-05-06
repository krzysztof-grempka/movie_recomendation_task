<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\InvalidNumberOfWordsException;
use App\Exception\NumberGreaterThanMovieAmount;

readonly class MovieRecommendationService
{
    public function getRandomMovies(array $movies, string $number): array
    {
        (new NumberGreaterThanMovieAmount())->execute($movies, $number);

        shuffle($movies);

        return array_slice($movies, 0, intval($number));
    }

    public function getMoviesWithEvenTitleThatStartsWithChar(array $movies, string $char): array
    {
        $char = strtolower(
            preg_replace(
                pattern: '/\s+/',
                replacement: '',
                subject: $char
            )
        );

        $filteredMovies = array_filter($movies, function (string $movie) use ($char) {
            $normalizedMovie = preg_replace(
                pattern: '/\s+/',
                replacement: '',
                subject:  mb_strtolower(
                    str_replace(
                        search: ['ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ż', 'ź'],
                        replace:  ['a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'],
                        subject: $movie
                    ),
                )
            );
            return str_starts_with($normalizedMovie, $char) && strlen($normalizedMovie) % 2 === 0;
        });

        $result = [];
        foreach ($filteredMovies as $movie) {
            $result[] = $movie;
        }

        return $result;
    }

    public function getMoviesWithTitleGreaterThanNumberOfWords(array $movies, string $numberOfWords): array
    {
        (new InvalidNumberOfWordsException())->execute($numberOfWords);
        $numberOfWords = intval($numberOfWords);

        return array_filter($movies, function (string $movie) use ($numberOfWords): bool {
            return count(preg_split('~[^\p{L}\p{N}\']+~u', $movie)) > $numberOfWords;
        });
    }
}
