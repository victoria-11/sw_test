<?php

use Symfony\Component\HttpFoundation\Request;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/urls/short', 'App\Controllers\UrlsController::create');
    $r->addRoute('GET', '/hello-world', function() {
        print_r(1111);
    });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

new Middlewares\Utils\Dispatcher([
    new App\Middlewares\MainGate($dispatcher, $uri),
]);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

$request = Request::createFromGlobals();

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";

        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];

        echo "405 Method Not Allowed";

        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        call_user_func($handler, $request);

        break;
}
