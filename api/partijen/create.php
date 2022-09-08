<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/partijen.php';

$database = new Database();
$db = $database->getConnection();

$party = new partijen($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->naam) &&
    !empty($data->leider) &&
    !empty($data->omschrijving)
){
    $party->naam = $data->naam;
    $party->leider = $data->leider;
    $party->omschrijving = $data->omschrijving;
    $party->date_time = date('Y-m-d H:i:s');

    // create the partij -> aanroep create() methode
    if ($party->create()) {
        // response code - 201 created
        response(array( "message" => "party was created"), 201);
    }
    else {
        // if unable to create the partij, tell the user
        // set response code - 503 service unavailable
        response(array("message" => "Unable to create party."), 503);
    }
}
else {
    // tell the user input JSON data is incomplete
    // set response code - 400 bad request
    response(array("message" => "Unable to create party. Data is incomplete."), 400);
}
