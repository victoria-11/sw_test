<?php

spl_autoload_register('autoload');

function autoload($className) {
    $path = prepareNamespace($className);

    $fullPath = __DIR__ . prepareNamespace($className);

    require_once($fullPath);
}

function prepareNamespace(string $namespace): string {
    $path = '';

    $parts = explode('\\', $namespace);

    $count = count($parts);

    foreach ($parts as $key => $value) {
        $isLast = $count == ++$key;

        if(!$isLast) {
            $value = mb_strtolower($value);
        }

        $path .= '/' . $value;
    }

    $path .= '.php';

    return $path;
}

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/app/routes.php');
