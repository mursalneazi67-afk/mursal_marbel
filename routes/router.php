<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

$file = __DIR__ . '/public' . $uri;

// Serve existing files directly
if ($uri !== '/' && is_file($file)) {
    return false;
}

// Send all other requests to Laravel
require __DIR__ . '/public/index.php';