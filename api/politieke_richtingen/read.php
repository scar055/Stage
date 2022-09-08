<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/politieke_richtingen.php';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
// initialize object
$politieke_richtingen = new politieke_richtingen($db);

// query products
$stmt = $politieke_richtingen->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if ($num>0) {
    // products array aanmaken
    $politieke_richting = [];

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    $politieke_richting_item = null;
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $politieke_richting_item = [
            "id" => $row->id,
            "partij_id" => $row->partij_id,
            "links" => $row->links,
            "rechts" => $row->rechts,
            "progressief" => $row->progressief,
            "conservatief" => $row->conservatief,
            "date_time" => $row->date_time,
        ];
        // voeg gevonden product toe aan products_arr["records"]
        array_push($politieke_richting, $politieke_richting_item);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($politieke_richtingen);
} else {
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no products found
    echo json_encode(array("message" => "geen richting gevonden."));
}
