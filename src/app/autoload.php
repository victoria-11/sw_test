<?php

require_once(__DIR__ . '/Router.php');
require_once(__DIR__ . '/DBConnection.php');

require_once(__DIR__ . '/middlewares/MainGate.php');

require_once(__DIR__ . '/usecases/MakeShortUrl.php');

require_once(__DIR__ . '/controllers/UrlsController.php');
require_once(__DIR__ . '/controllers/HomeController.php');
require_once(__DIR__ . '/controllers/MyUrlController.php');

require_once(__DIR__ . '/routes.php');
