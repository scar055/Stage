<?php

class stellingen
{
    // database connection en tabel naam
    private $conn;
    private $table_name = "stellingen";

    //properties
    public $id;
    public $omschrijving;
    public $date_time;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read() {
        // select all query
        $query = "SELECT p.id, p.omschrijving, p.date_time FROM "
            . $this->table_name . " p ORDER BY p.date_time DESC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function create() {
        // query to insert record
        $query = "INSERT INTO " . $this->table_name ."
         SET 
         omschrijving=:omschrijving";
        // prepare query
        $stmt =  $this->conn->prepare($query);

        //sanitize query
        $this->omschrijving=htmlspecialchars(strip_tags($this->omschrijving));

        //bind values
        $stmt->bindparam(":omschrijving", $this->omschrijving);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function readone() {
        $query = "SELECT p.id, p.omschrijving, p.date_time FROM "
            . $this->table_name . " p WHERE p.id = ? LIMIT 0,1";
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //bind id to be updated
        $stmt->bindparam(1, $this->id);

        //execute query
        $stmt->execute();

        //get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //get value back to object properties
        if (!empty($row['omschrijving'])) {
            $this->omschrijving = $row['omschrijving'];
        }
    }
    function update(){
        // update query
        $query = "UPDATE 
        ". $this->table_name ."
            SET 
                omschrijving = :omschrijving
            WHERE 
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->omschrijving=htmlspecialchars(strip_tags($this->omschrijving));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':omschrijving', $this->omschrijving);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute() && $stmt->rowCount()){
            return true;
        }
        return false;
    }
    function delete() {
        //delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        //prepare query
        $stmt = $this->conn->prepare($query);

        //sanitze
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id to delete query
        $stmt->bindParam(1, $this->id);

        // execute the query
        if($stmt->execute() && $stmt->rowCount()){
            return true;
        }
        return false;
    }
}
