<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/partijen.php';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
// initialize object
$partijen = new partijen($db);

// query products
$stmt = $partijen->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if ($num>0) {
    // products array aanmaken
    $partijen_arr = [];

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    $partijen_item = null;
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $partijen_item = [
            "id" => $row->id,
            "name" => $row->naam,
            "leader" => $row->leider,
            "description" => html_entity_decode($row->omschrijving),
            "date_time" => $row->date_time,
        ];
        // voeg gevonden product toe aan products_arr["records"]
        array_push($partijen_arr, $partijen_item);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($partijen_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no products found
    echo json_encode(array("message" => "geen partijen gevonden."));
}