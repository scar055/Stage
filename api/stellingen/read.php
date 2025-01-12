<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/stellingen.php';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
// initialize object
$stellingen = new stellingen($db);

// query products
$stmt = $stellingen->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if ($num>0) {
    // products array aanmaken
    $stelling = [];

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    $stelling_item = null;
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $stelling_item = [
            "id" => $row->id,
            "omschrijving" => html_entity_decode($row->omschrijving),
            "date_time" => $row->date_time,
        ];
        // voeg gevonden product toe aan products_arr["records"]
        array_push($stelling, $stelling_item);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($stelling);
} else {
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no products found
    echo json_encode(array("message" => "geen stellingen gevonden."));
}