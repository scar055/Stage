<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../inc/bootstrap.php';
include_once '../objects/partijen_antwoorden.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

//prepare partij object
$partijen_antwoorden = new partijen_antwoorden($db);

// get id of partijen to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij to be edited
$partijen_antwoorden->id = $data->id;

//delete partij
if ($partijen_antwoorden->delete()) {
    response(array("message" => "partij antwoord was deleted"), 200);
} else {
    response(array("message" => "partij antwoord bestaad niet"), 503);
}