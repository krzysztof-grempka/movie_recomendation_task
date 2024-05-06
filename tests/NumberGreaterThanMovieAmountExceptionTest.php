<?php

declare(strict_types=1);

namespace App\Tests;

use App\Exception\NumberGreaterThanMovieAmount;
use PHPUnit\Framework\TestCase;

class NumberGreaterThanMovieAmountExceptionTest extends TestCase
{
    private array $movies = ["Movie 1", "Movie 2", "Movie 3"];

    public function testExecuteThrowsExceptionWhenNumberGreaterThanMovieAmount(): void
    {
        $exception = new NumberGreaterThanMovieAmount();

        $this->expectException(\InvalidArgumentException::class);
        $exception->execute(
            movies: $this->movies,
            number: "4"
        );
    }

    public function testExecuteDoesNotThrowExceptionWhenNumberEqualToMovieAmount(): void
    {
        $exception = new NumberGreaterThanMovieAmount();

        $this->expectNotToPerformAssertions();
        $exception->execute(
            movies: $this->movies,
            number: "3"
        );
    }

    public function testExecuteDoesNotThrowExceptionWhenNumberLessThanMovieAmount(): void
    {
        $exception = new NumberGreaterThanMovieAmount();

        $this->expectNotToPerformAssertions();
        $exception->execute(
            movies: $this->movies,
            number: "2"
        );
    }
}
