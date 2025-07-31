<?php
require __DIR__ . '/bootstrap.php';
require_once COMPONENTS_PATH . '/errorHandler.component.php';

if (php_sapi_name() === 'cli-server') {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = BASE_PATH . $urlPath;
    if (is_file($file)) {
        return false;
    }
}

// Check if the requested page exists
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

// Define valid routes
$validRoutes = [
    '/',
    '/index.php',
    '/pages/LoginPage/index.php',
    '/pages/Homepage/index.php'
];

// Check if route exists
if (!in_array($path, $validRoutes)) {
    handle404();
}

require BASE_PATH . '/index.php'; 
