<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$container = require __DIR__ . '/config/di.php';
$routes = require_once __DIR__ . '/config/routes.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

foreach ($routes as $route => $config) {
    $pattern = str_replace('/', '\/', $route);
    $pattern = preg_replace('/\{[^}]+}/', '([^\/]+)', $pattern);
    $pattern = '/^' . $pattern . '$/';

    if (preg_match($pattern, $requestUri, $matches)) {
        $controllerName = $config['controller'];
        $methodName = $config['method'];

        try {
            $controller = $container->get($controllerName);
            if (method_exists($controller, $methodName)) {
                $params = array_slice($matches, 1);
                echo call_user_func_array([$controller, $methodName], $params);
            } else {
                throw new Exception("Method $methodName does not exist in $controllerName");
            }
            exit;
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}

echo "404 Not Found";
