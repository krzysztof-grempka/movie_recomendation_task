<?php

declare(strict_types=1);

namespace App\Exception;

final class NumberGreaterThanMovieAmount extends \Exception
{
    public function execute(array $movies, string $number): void
    {
        if (!ctype_digit($number) || $number > count($movies)) {
            throw new \InvalidArgumentException('Number of movies should be integer not greater than amount of all movies');
        }
    }
}
