<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/database.php';
include_once '../inc/bootstrap.php';
include_once '../objects/partijen.php';

// instantiate database and partij object
$database = new Database();
$db = $database->getConnection();

//prepare partij object
$partijen = new partijen($db);

$partijen->id = isset($_GET['id']) ? $_GET['id'] : die();

$partijen->readone();

if ($partijen->naam!=null) {
    $partijen_arr = array(
        "id"=> $partijen->id,
        "naam" => $partijen->naam,
        "leider" => $partijen->leider,
        "omschrijving" => $partijen->omschrijving
    );

    // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($partijen_arr);
}
else {
    response(array( "message" => "party does not exist"), 404);
}