<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyUrlController
{

    public function index(Request $request): string {
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );

        $response->setContent('You were redirected. Hello from MyUrlController!');

        return $response->send();
    }
}
