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
include_once '../objects/politieke_richtingen.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

//prepare partij_antwoorden object
$politieke_richtingen = new politieke_richtingen($db);

// get id of partij_antwoorden to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij_antwoorden to be edited
$politieke_richtingen->id = $data->id;

//set property values
$politieke_richtingen->partij_id = $data->partij_id;
$politieke_richtingen->links = $data->links;
$politieke_richtingen->rechts = $data->rechts;
$politieke_richtingen->progressief = $data->progressief;
$politieke_richtingen->conservatief = $data->conservatief;


// update de partijen_antwoorden
if ($politieke_richtingen->update()) {
    // tell user and set response code
    response(array("message" => "politieke richting was updated"), 200);
} else {
    // set response code if it does not work and sent message
    response(array("message" => "unable to update politieke richting"), 503);
}