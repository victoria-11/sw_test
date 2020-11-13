<?php

namespace App\Middlewares;

use App\DBConnection;
use App\Router;

use Shortener\DBService;

use Predis\Client;

class MainGate
{

    const REDIS_HOST = 'redis';

    const REDIS_PORT = 6379;

    const TTL = 3600;

    public function __construct(Router $router)
    {
        $this->initRedis();

        $longUrl = $this->findLongUrl($router->uri);

        if($longUrl) {
            $this->cache(
                $router->uri,
                $longUrl
            );

            return $this->redirect($longUrl);
        }

        return $router->dispatch();
    }

    protected function redirect(string $url): void {
        $location = 'http://' . $_SERVER['HTTP_HOST'] . $url;

        header("Location: " . $location);
    }

    protected function initRedis(): void {
        $this->redis = new Client([
            'host' => self::REDIS_HOST,
            'port' => self::REDIS_PORT,
        ]);
    }

    protected function findLongUrl(string $shortUrl): ?string {
        $longUrl = $this->redis->get($shortUrl);

        if(!$longUrl) {
            $longUrl = $this->findLongUrlInDB($shortUrl);
        }

        return $longUrl;
    }

    protected function findLongUrlInDB(string $url): ?string {
        $longUrl = null;

        $connection = DBConnection::connect();

        $dbService = new DBService($connection);

        $model = $dbService->find($url);

        if($model) {
            $longUrl = $model->longUrl;
        }

        return $longUrl;
    }

    protected function cache(string $shortUrl, string $longUrl): void {
        $this->redis->setEx($shortUrl, self::TTL, $longUrl);
    }
}
