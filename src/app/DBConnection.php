<?php

namespace App;

class DBConnection
{

    const DB_HOST = 'localhost';

    const DB_USER = 'root';

    const DB_PASSWORD = 'secret';

    const DB_NAME = 'db';

    public static function connect(): \PDO {
        return new \PDO(
            'mysql:dbname=' . self::DB_NAME. ';host=' . self::DB_HOST . ';port=3306',
            self::DB_USER,
            self::DB_PASSWORD
        );
    }
}
