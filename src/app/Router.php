<?php

namespace App;

use FastRoute\Dispatcher;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{

    public $dispatcher;

    public $method;

    public $uri;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        $this->setMethod();
        $this->parseUri();
    }

    public function dispatch(): void {
        $routeInfo = $this->getRouteInfo();

        $this->callController($routeInfo);
    }

    public function getRouteInfo(): array {
        return $this->dispatcher->dispatch(
            $this->method,
            $this->uri
        );
    }

    protected function callController(array $routeInfo): void {
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $this->send404();

                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];

                echo "405 Method Not Allowed";

                break;
            case Dispatcher::FOUND:
                $this->runController($routeInfo);

                break;
        }
    }

    protected function runController(array $routeInfo): void {
        $request = Request::createFromGlobals();

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        call_user_func($handler, $request);
    }

    protected function send404(): void {
        echo "<pre>";
        echo "You tried to get the address " . $this->uri;
        echo "\n";
        echo "404 Not Found";
        echo "</pre>";
    }

    protected function setMethod(): void {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    protected function parseUri(): void {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $this->uri = rawurldecode($uri);
    }
}
