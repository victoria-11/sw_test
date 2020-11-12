<?php

require_once(__DIR__ . '/DBConnection.php');

require_once(__DIR__ . '/middlewares/MainGate.php');

require_once(__DIR__ . '/usecases/MakeShortUrl.php');

require_once(__DIR__ . '/controllers/UrlsController.php');

// require_once(__DIR__ . '/router.php');

use App\DBConnection;

$pdo = new DBConnection();

$pdo::connect();

// print_r($pdo);

echo "from app222";