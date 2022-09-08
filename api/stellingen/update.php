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

//prepare partij_antwoorden object
$stellingen = new stellingen($db);

// get id of partij_antwoorden to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij_antwoorden to be edited
$stellingen->id = $data->id;

//set property values
$stellingen->omschrijving = $data->omschrijving;

// update de partijen_antwoorden
if ($stellingen->update()) {
    // tell user and set response code
    response(array("message" => "stelling was updated"), 200);
} else {
    // set response code if it does not work and sent message
    response(array("message" => "unable to update stelling"), 503);
}