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
include_once '../objects/partijen.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

//prepare partij object
$partijen = new partijen($db);

// get id of partijen to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij to be edited
$partijen->id = $data->id;

//set property values
$partijen->naam = $data->naam;
$partijen->leider = $data->leider;
$partijen->omschrijving = $data->omschrijving;

// update de partijen
if ($partijen->update()) {
    // tell user and set response code
    response(array("message" => "partijen was updated"), 200);
} else {
    // set response code if it does not work and sent message
    response(array("message" => "unable to update partijen"), 503);
}