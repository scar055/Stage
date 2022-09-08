<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/database.php';
include_once '../inc/bootstrap.php';
include_once '../objects/partijen_antwoorden.php';

// instantiate database and partij_antwoorden object
$database = new Database();
$db = $database->getConnection();

//prepare partij_antwoorden object
$partijen_antwoorden = new partijen_antwoorden($db);

$partijen_antwoorden->id = isset($_GET['id']) ? $_GET['id'] : die();

$partijen_antwoorden->readone();

if ($partijen_antwoorden->stelling_id!=null) {
    $partijen_arr = array(
        "id"=> $partijen_antwoorden->id,
        "stelling_id" => $partijen_antwoorden->stelling_id,
        "partij_id" => $partijen_antwoorden->partij_id,
        "antwoord" => $partijen_antwoorden->antwoord
    );

    // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($partijen_arr);
}
else {
    response(array( "message" => "answer does not exist"), 404);
}