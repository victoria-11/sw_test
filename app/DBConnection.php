<?php

namespace App;

class DBConnection
{

    const DB_HOST = 'localhost';

    const DB_USER = 'root';

    const DB_PASSWORD = 'foo';

    const DB_NAME = 'shorty';

    public static function connect(): \PDO {
        return new \PDO(
            'mysql:dbname=' . self::DB_NAME. ';host=' . self::DB_HOST,
            self::DB_USER,
            self::DB_PASSWORD
        );
    }
}
