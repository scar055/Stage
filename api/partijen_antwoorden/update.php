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

//prepare partij_antwoorden object
$partijen_antwoorden = new partijen_antwoorden($db);

// get id of partij_antwoorden to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij_antwoorden to be edited
$partijen_antwoorden->id = $data->id;

//set property values
$partijen_antwoorden->stelling_id = $data->stelling_id;
$partijen_antwoorden->partij_id = $data->partij_id;
$partijen_antwoorden->antwoord = $data->antwoord;

// update de partijen_antwoorden
if ($partijen_antwoorden->update()) {
    // tell user and set response code
    response(array("message" => "partij_antwoorden was updated"), 200);
} else {
    // set response code if it does not work and sent message
    response(array("message" => "unable to update partij_antwoorden"), 503);
}