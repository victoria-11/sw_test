<?php

namespace Shortener;

class Model
{

    public $id;

    public $longUrl;

    public $shortUrl;

    public $createdAt;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->shortUrl = $data['short_url'];
        $this->longUrl = $data['long_url'];
        $this->createdAt = $data['created_at'];
    }

}
