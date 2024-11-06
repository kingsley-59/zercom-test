<?php

use App\Controller\BaseController;
use App\Controller\StudentController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$studentController = new StudentController();

if ($requestMethod == 'GET') {
    $response = $studentController->findAllWithCenterNames();
    header($response['status_code_header']);
    if ($response['body']) {
        echo json_encode($response['body']);
    }
} else {
    $response = BaseController::unprocessableEntity();
    echo json_encode($response['body']);
}
