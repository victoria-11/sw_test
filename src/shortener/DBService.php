<?php

namespace Shortener;

use Shortener\DBServiceInterface;
use Shortener\Model;

class DBService implements DBServiceInterface
{

    protected $connection;

    protected $domain;

    public function __construct(\PDO $connection, string $domain = '')
    {
        $this->connection = $connection;
        $this->domain = $domain;
    }

    public function find(string $url): ?Model
    {
        $result = null;

        $statement = $this->connection->prepare(
            'SELECT * FROM urls WHERE short_url = ?'
        );

        $statement->execute([
            $url
        ]);

        $data = $statement->fetch(\PDO::FETCH_ASSOC);

        if($data) {
            $result = new Model($data);
        }

        return $result;
    }

    public function save(string $longUrl, string $shortUrl): Model
    {
        $statement = $this->connection->prepare(
            'INSERT INTO urls (long_url, short_url, created_at) VALUES (?,?,?)'
        );

        $createdAt = date('Y-m-d H:i:s');

        $statement->execute([
            $longUrl,
            $this->genFullUrl($shortUrl),
            $createdAt,
        ]);

        $data = [
            'id' => $this->connection->lastInsertId(),
            'short_url' => $shortUrl,
            'long_url' => $longUrl,
            'created_at' => $createdAt,
        ];

        $model = new Model($data);

        return $model;
    }

    protected function genFullUrl(string $url): string {
        return "{$this->domain}/{$url}";
    }
}
