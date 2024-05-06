<?php

declare(strict_types=1);

namespace App\Provider;

use App\Exception\MoviesArrayException;

class MoviesProvider
{
    /**
     * @throws MoviesArrayException
     */
    public function getMovies(): array
    {
        $filePath = __DIR__ . '/../../resources/movies.php';
        if (!file_exists($filePath)) {
            throw new MoviesArrayException('Movie file does not exist');
        }

        include $filePath;

        if (isset($movies) && is_array($movies)) {

            return $movies;
        }

        return [];
    }
}
