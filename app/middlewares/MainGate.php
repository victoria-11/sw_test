<?php

namespace App\Middlewares;

use FastRoute\Dispatcher;

use App\DBConnection;

use Shortener\DBService;

class MainGate
{

    public function __construct(Dispatcher $dispatcher, string $uri)
    {
        $connection = DBConnection::connect();

        $dbService = new DBService($connection);

        $model = $dbService->find($uri);

        if($model) {
            $location = 'http://' . $_SERVER['HTTP_HOST'] . $model->longUrl;

            header("Location: " . $location);

            die;
        }
    }
}
