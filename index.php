<?php

require_once "vendor/autoload.php";
header("Access-Control-Allow-Origin: *");

use Bramus\Router\Router;
use Controllers\CountryController;

$route = new Router;

$route->get("/", [CountryController::class, 'save']);
$route->get("/countrys", [CountryController::class, 'getAll']);
$route->get("/countrys/{id}",[CountryController::class, 'get']);
$route->run();

// $conn = $db->getConnection();
