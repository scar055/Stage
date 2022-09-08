<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/database.php';
include_once '../inc/bootstrap.php';
include_once '../objects/politieke_richtingen.php';

// instantiate database and politieke_richtingen object
$database = new Database();
$db = $database->getConnection();

//prepare politieke_richtingen object
$politieke_richtingen = new politieke_richtingen($db);

$politieke_richtingen->id = isset($_GET['id']) ? $_GET['id'] : die();

$politieke_richtingen->readone();

if ($politieke_richtingen->partij_id!=null) {
    $partijen_arr = array(
        "id"=> $politieke_richtingen->id,
        "partij_id" => $politieke_richtingen->partij_id,
        "links" => $politieke_richtingen->links,
        "rechts" => $politieke_richtingen->rechts,
        "progressief" => $politieke_richtingen->progressief,
        "conservatief" => $politieke_richtingen->conservatief
    );

    // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($partijen_arr);
}
else {
    response(array( "message" => "answer does not exist"), 404);
}