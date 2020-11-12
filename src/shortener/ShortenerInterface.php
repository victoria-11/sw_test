<?php

namespace Shortener;

interface ShortenerInterface
{
    public function doShort(string $url): string;

    public function doLong(string $url): string;

    public function setChars(string $chars): void;

    public function setSalt(string $salt): void;

    public function setPadding(string $padding): void;

}
