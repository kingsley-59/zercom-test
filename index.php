<?php

require_once('bootstrap.php');
require './vendor/autoload.php';

// Define the routes and their corresponding scripts
$routes = [
    '/' => 'home.php',
    '/students/centre' => './src/Routes/get_students_with_center.php',
    '/students/category' => 'contact.php',
];

// Get the requested path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the requested path exists in the routes
if (array_key_exists($path, $routes)) {
    // Include the corresponding script
    include $routes[$path];
} else {
    // If the path does not exist, show a 404 error
    http_response_code(404);
    echo '404 Not Found';
}