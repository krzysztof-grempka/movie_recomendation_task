<?php

declare(strict_types=1);

namespace App\Exception;

final class NumberLowerThanOneException extends \Exception
{
    public function execute(string $number): void
    {
        if (!ctype_digit($number) || $number < 1) {
            throw new \InvalidArgumentException('Number of movies should be integer and greater than one');
        }
    }
}
