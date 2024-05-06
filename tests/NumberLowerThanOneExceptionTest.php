<?php

declare(strict_types=1);

namespace App\Tests;

use App\Exception\NumberLowerThanOneException;
use PHPUnit\Framework\TestCase;

class NumberLowerThanOneExceptionTest extends TestCase
{
    public function testExecuteThrowsExceptionWhenNumberLowerThanOne(): void
    {
        $exception = new NumberLowerThanOneException();

        $this->expectException(\InvalidArgumentException::class);
        $exception->execute("0");
    }

    public function testExecuteDoesNotThrowExceptionWhenNumberEqualToOne(): void
    {
        $exception = new NumberLowerThanOneException();

        $this->expectNotToPerformAssertions();
        $exception->execute("1");
    }

    public function testExecuteDoesNotThrowExceptionWhenNumberGreaterThanOne(): void
    {
        $exception = new NumberLowerThanOneException();

        $this->expectNotToPerformAssertions();
        $exception->execute("2");
    }
}
