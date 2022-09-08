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
include_once '../objects/politieke_richtingen.php';

$database = new Database();
$db = $database->getConnection();

$politieke_richting = new politieke_richtingen($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->partij_id) &&
    $data->links != null &&
    $data->rechts != null &&
    $data->progressief != null &&
    $data->conservatief != null
){
    $politieke_richting->partij_id = $data->partij_id;
    $politieke_richting->links = $data->links;
    $politieke_richting->rechts = $data->rechts;
    $politieke_richting->progressief = $data->progressief;
    $politieke_richting->conservatief = $data->conservatief;

    // create the politieke richting -> aanroep create() methode
    if ($politieke_richting->create()) {
        // response code - 201 created
        response(array( "message" => "politieke richting was created"), 201);
    }
    else {
        // if unable to create politieke richting, tell the user
        // set response code - 503 service unavailable
        response(array("message" => "Unable to create politieke richting."), 503);
    }
}
else {
    // tell the user input JSON data is incomplete
    // set response code - 400 bad request
    response(array("message" => "Unable to create politieke richting. Data is incomplete."), 400);
}
