<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\HtmlGenerator;

class HtmlGeneratorTest extends TestCase
{
    public function testGenerateHtmlWithEmptyMovies(): void
    {
        $htmlGenerator = new HtmlGenerator();
        $movies = [];

        ob_start();
        $htmlGenerator->generateHtml($movies);
        $output = ob_get_clean();

        $this->assertStringContainsString('<div>', $output);
        $this->assertStringContainsString('<h1>Lista filmów</h1>', $output);
        $this->assertStringContainsString('<ul>', $output);
        $this->assertStringContainsString('<p>Nie znaleziono filmów</p>', $output);
        $this->assertStringNotContainsString('<li>', $output);
    }

    public function testGenerateHtmlWithNonEmptyMovies(): void
    {
        $htmlGenerator = new HtmlGenerator();
        $movies = ['Film 1', 'Film 2', 'Film 3'];

        ob_start();
        $htmlGenerator->generateHtml($movies);
        $output = ob_get_clean();

        $this->assertStringContainsString('<div>', $output);
        $this->assertStringContainsString('<h1>Lista filmów</h1>', $output);
        $this->assertStringContainsString('<ul>', $output);
        $this->assertStringNotContainsString('<p>Nie znaleziono filmów</p>', $output);
        $this->assertStringContainsString('<li>Film 1</li>', $output);
        $this->assertStringContainsString('<li>Film 2</li>', $output);
        $this->assertStringContainsString('<li>Film 3</li>', $output);
    }

}
