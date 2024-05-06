<?php

declare(strict_types=1);

namespace App\Tests;

use App\Exception\InvalidNumberOfWordsException;
use PHPUnit\Framework\TestCase;

class InvalidNumberOfWordsExceptionTest extends TestCase
{
    public function testInvalidNumberOfWordsExceptionTest(): void
    {
        $exception = new InvalidNumberOfWordsException();

        $this->expectException(\InvalidArgumentException::class);
        $exception->execute("A");
    }
}
