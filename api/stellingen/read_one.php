<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/database.php';
include_once '../inc/bootstrap.php';
include_once '../objects/stellingen.php';

// instantiate database and stellingen object
$database = new Database();
$db = $database->getConnection();

//prepare stellingen object
$stellingen = new stellingen($db);

$stellingen->id = isset($_GET['id']) ? $_GET['id'] : die();

$stellingen->readone();

if ($stellingen->omschrijving!=null) {
    $partijen_arr = array(
        "id"=> $stellingen->id,
        "omschrijving" => $stellingen->omschrijving
    );

    // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($partijen_arr);
}
else {
    response(array( "message" => "answer does not exist"), 404);
}