<?php

declare(strict_types=1);

namespace App\Exception;

class InvalidNumberOfWordsException extends \Exception
{
    public function execute(string $number): void
    {
        if (!ctype_digit($number) || $number <= 0) {
            throw new \InvalidArgumentException('The number of words should be an integer greater than zero');
        }
    }
}
