<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../inc/bootstrap.php';
include_once '../config/database.php';
include_once '../objects/stellingen.php';

$database = new Database();
$db = $database->getConnection();

$stellingen = new stellingen($db);

$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->omschrijving)
){
    $stellingen->omschrijving = $data->omschrijving;

    // create the stelling -> aanroep create() methode
    if ($stellingen->create()) {
        // response code - 201 created
        response(array( "message" => "stelling was created"), 201);
    }
    else {
        // if unable to create the antwoord, tell the user
        // set response code - 503 service unavailable
        response(array("message" => "Unable to create stelling."), 503);
    }
}
else {
    // tell the user input JSON data is incomplete
    // set response code - 400 bad request
    response(array("message" => "Unable to create stelling. Data is incomplete."), 400);
}
