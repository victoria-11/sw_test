<?php

namespace App;

class DBConnection
{

    const DB_HOST = 'db';

    const DB_USER = 'dev';

    const DB_PASSWORD = 'secret';

    const DB_NAME = 'sw_test';

    public static function connect(): \PDO {
        return new \PDO(
            'mysql:dbname=' . self::DB_NAME. ';host=' . self::DB_HOST,
            self::DB_USER,
            self::DB_PASSWORD
        );
    }
}
