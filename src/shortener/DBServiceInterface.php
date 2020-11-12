<?php

namespace Shortener;

use Shortener\Model;

interface DBServiceInterface
{

    public function __construct(\PDO $connection, string $domain);

    public function find(string $url): ?Model;

    public function save(string $longUrl, string $shortUrl): Model;

}
