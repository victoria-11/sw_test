<?php

use App\Router;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/urls/short', 'App\Controllers\UrlsController::create');
    $r->addRoute('GET', '/', 'App\Controllers\HomeController::index');
    $r->addRoute('GET', '/my-url', 'App\Controllers\MyUrlController::index');
});

$router = new Router($dispatcher);

new Middlewares\Utils\Dispatcher([
    new App\Middlewares\MainGate($router),
]);
