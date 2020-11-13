<?php

namespace Shortener;

use Shortener\UrlShortener;
use Shortener\ShortenerInterface;
use Shortener\DBServiceInterface;
use Shortener\Model;

class Service
{

    protected $dbService;
    protected $shortener;

    public function __construct(DBServiceInterface $dbService)
    {
        $this->dbService = $dbService;

        $this->initDefaultShortener();
    }

    public function setShortener(ShortenerInterface $shortener): void {
        $this->shortener = $shortener;
    }

    public function doShort(string $url): string {
        return $this->shortener->doShort($url);
    }

    public function doLong(string $url): string {
        return $this->shortener->doLong($url);
    }

    public function save(string $longUrl, string $shortUrl): Model {
        return $this->dbService->save(
            $this->prepareUrl($longUrl),
            $shortUrl
        );
    }

    public function find(string $url): ?Model {
        return $this->dbService->find($url);
    }

    public function setChars(string $chars): void {
        $this->shortener->setChars($chars);
    }

    public function setSalt(string $salt): void {
        $this->shortener->setSalt($salt);
    }

    public function setPadding(string $padding): void {
        $this->shortener->setPadding($padding);
    }

    protected function initDefaultShortener(): void
    {
        $shortener = new UrlShortener();

        $this->setShortener($shortener);
    }

    protected function prepareUrl(string $url): string {
        $firstChar = $url[0];

        if($firstChar != '/') {
            $url = "/{$url}";
        }

        return $url;
    }

}
