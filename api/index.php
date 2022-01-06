<?php

declare(strict_types=1);

require dirname(__DIR__) . "/vendor/autoload.php";

set_exception_handler("ErrorHandler::handleException");

$path = parse_url($_SERVER ["REQUEST_URI"], PHP_URL_PATH);

$parts = explode("/", $path);

header("Content-type: application/json; charset=UTF-8");

$database = new Database("localhost", "audit", "root", "");

$database->getConnection();

$user_gateway = new UserGateway($database);

