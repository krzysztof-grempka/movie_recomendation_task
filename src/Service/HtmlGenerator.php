<?php

declare(strict_types=1);

namespace App\Service;

readonly class HtmlGenerator
{
    public function generateHtml(array $movies): void
    {
        require __DIR__ . '/../../templates/index.html';
    }
}
