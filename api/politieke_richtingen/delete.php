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

//prepare partij object
$politieke_richtingen = new politieke_richtingen($db);

// get id of partijen to be edited
$data = json_decode(file_get_contents("php://input"));

// set id property of partij to be edited
$politieke_richtingen->id = $data->id;

//delete partij
if ($politieke_richtingen->delete()) {
    response(array("message" => "politieke_richtingen was deleted"), 200);
} else {
    response(array("message" => "politieke_richtingen bestaad niet"), 503);
}