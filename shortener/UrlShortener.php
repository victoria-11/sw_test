<?php

namespace Shortener;

use Shortener\ShortenerInterface;

class UrlShortener implements ShortenerInterface
{

    protected $chars;

    protected $salt;

    protected $padding;

    public function setChars(string $chars): void {
        $this->chars = $chars;
    }

    public function setSalt(string $salt): void {
        $this->salt = $salt;
    }

    public function setPadding(string $padding): void {
        $this->padding = $padding;
    }

    public function doShort(string $url): string {
        $k = 0;
        $n = time();

        if ($this->padding > 0 && !empty($this->salt)) {
            $k = $this->hash($n, $this->salt, $this->padding);

            $n = (int) ($k.$n);
        }

        return $this->numToAlpha($n, $this->chars);

        return $url;
    }

    protected static function hash($n, $salt, $padding) {
        $hash = md5($n.$salt);

        $dec = hexdec(substr($hash, 0, $padding));

        $num = $dec % pow(10, $padding);

        if ($num == 0) {
            $num = 1;
        }

        $num = str_pad($num, $padding, '0');

        return $num;
    }

    protected static function numToAlpha($n, $s) {
        $b = strlen($s);

        $m = $n % $b;

        if ($n - $m == 0) return substr($s, $n, 1);

        $a = '';

        while ($m > 0 || $n > 0) {
            $a = substr($s, $m, 1).$a;
            $n = ($n - $m) / $b;
            $m = $n % $b;
        }

        return $a;
    }

    public function doLong(string $url): string {
        return $url;
    }

}
