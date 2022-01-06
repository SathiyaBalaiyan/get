<?php

declare(strict_types=1);

require dirname(__DIR__) . "/vendor/autoload.php";

set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

if($_SERVER["REQUEST_METHOD"] !== "POST")
{
    http_response_code(405);
    header("Allow: POST");
    exit;
}

$data =(array) json_decode(file_get_contents("php://input"), true); 

if (! array_key_exists("username", $data))
{
    http_response_code(400);
    echo json_encode(["message" => "missing username"]);
    exit;
}

$database = new Database("localhost", "audit", "root", "");

$user_gateway = new UserGateway($database);

$user = $user_gateway->getByUsername($data["username"]);

if ($user === false)
{
    http_response_code(401);
    echo json_encode(["message" => "invalid authentication"]);
    exit;
}
else 
{
    echo json_encode($user);
}

