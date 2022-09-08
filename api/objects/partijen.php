<?php

class partijen
{
    // database connection en tabel naam
    /**
     * @var $conn PDO
     */
    private $conn;
    private $table_name = "partijen";

    //properties
    public $id;
    public $naam;
    public $leider;
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
        $query = "SELECT p.id, p.naam, p.leider, p.omschrijving, p.date_time FROM "
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
         naam=:naam, leider=:leider, omschrijving=:omschrijving";
        // prepare query
        $stmt =  $this->conn->prepare($query);

        //sanitize query
        $this->naam=htmlspecialchars(strip_tags($this->naam));
        $this->leider=htmlspecialchars(strip_tags($this->leider));
        $this->omschrijving=htmlspecialchars(strip_tags($this->omschrijving));

        //bind values
        $stmt->bindparam(":naam", $this->naam);
        $stmt->bindparam(":leider", $this->leider);
        $stmt->bindparam(":omschrijving", $this->omschrijving);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function readone() {
        $query = "SELECT p.id, p.naam, p.leider, p.omschrijving, p.date_time FROM "
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
        if (!empty($row['naam'])) {
            $this->naam = $row['naam'];
        }
        if (!empty($row['leider'])) {
            $this->leider = $row['leider'];
        }
        if (!empty($row['omschrijving'])) {
            $this->omschrijving = $row['omschrijving'];
        }
    }
    // update the product
    function update(){
        // update query
        $query = "UPDATE 
        ". $this->table_name ."
            SET 
                naam = :naam, 
                leider = :leider,
                omschrijving = :omschrijving
            WHERE 
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->naam=htmlspecialchars(strip_tags($this->naam));
        $this->leider=htmlspecialchars(strip_tags($this->leider));
        $this->omschrijving=htmlspecialchars(strip_tags($this->omschrijving));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':leider', $this->leider);
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