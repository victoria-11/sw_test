<?php

namespace App\Controllers;

use App\DBConnection;

use App\Usecases\MakeShortUrl;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UrlsController
{

    public function create(Request $request): string {
        $params = json_decode($request->getContent(), true);

        $url = $params['url'] ?? '';

        $connection = DBConnection::connect();

        $usecase = new MakeShortUrl($connection);

        $data = $usecase->execute($url)->exportAsJson();

        $response = JsonResponse::fromJsonString($data);

        echo $response;
    }
}
