<?php

namespace App\Usecases;

use Shortener\UrlShortener;
use Shortener\Service;
use Shortener\DBService;
use Shortener\Model;

class MakeShortUrl
{

    protected $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    protected $salt = '';

    protected $padding = 3;

    protected $domain = '';

    protected $service;

    protected $model;

    public function __construct(\PDO $connection)
    {
        $dbService = new DBService($connection, $this->domain);

        $this->service = new Service($dbService);

        $this->service->setChars($this->chars);
        $this->service->setSalt($this->salt);
        $this->service->setPadding($this->padding);
    }

    public function execute(string $url): MakeShortUrl {
        $short = $this->service->doShort($url);

        $this->model = $this->service->save($url, $short);

        return $this;
    }

    public function exportAsJson(): string {
        return json_encode($this->model);
    }
}
