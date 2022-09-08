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
include_once '../objects/stellingen.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

//prepare partij object
$stellingen = new stellingen($db);

// get id of partijen to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij to be edited
$stellingen->id = $data->id;

//delete partij
if ($stellingen->delete()) {
    response(array("message" => "stelling was deleted"), 200);
} else {
    response(array("message" => "stelling bestaad niet"), 503);
}