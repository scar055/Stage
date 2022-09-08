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
include_once '../objects/partijen_antwoorden.php';

$database = new Database();
$db = $database->getConnection();

$party_answers = new partijen_antwoorden($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->stelling_id) &&
    !empty($data->partij_id) &&
    !empty($data->antwoord)
){
    $party_answers->stelling_id = $data->stelling_id;
    $party_answers->partij_id = $data->partij_id;
    $party_answers->antwoord = $data->antwoord;

    // create the partij_antwoorden -> aanroep create() methode
    if ($party_answers->create()) {
        // response code - 201 created
        response(array( "message" => "answer was created"), 201);
    }
    else {
        // if unable to create the antwoord, tell the user
        // set response code - 503 service unavailable
        response(array("message" => "Unable to create answer."), 503);
    }
}
else {
    // tell the user input JSON data is incomplete
    // set response code - 400 bad request
    response(array("message" => "Unable to create answer. Data is incomplete."), 400);
}
