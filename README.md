# Movie Recommendation Task

## Requirements
    php "^8.3",
    composer

## Preparation

```shell
composer install
```

## Static Code Analysis & Unit Tests
      "php-lint",
      "csfixer",
      "phpstan"
      "phpunit"

```shell
composer codetest
composer phpunit
```

## Run Development Server
```shell
php -S localhost:8000
```

Project available at: http://localhost:8000

Routes:
http://localhost:8000 -> all movies,

http://localhost:8000/random/3 -> random movies in the quantity of {number}, example 3

http://localhost:8000/even-title-and-starts-with-char/w -> movies with an even title and the title starts with
the provided character {char}, example W

http://localhost:8000/title-greater-than/1 -> movies that have a title with more than {numberOfWords}, example 1

