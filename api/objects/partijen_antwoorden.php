<?php

class partijen_antwoorden
{
    // database connection en tabel
    /**
     * @var $conn PDO
     */
    private $conn;
    private $table_name = "partijen_antwoorden";

    //properties
    public $id;
    public $stelling_id;
    public $partij_id;
    public $antwoord;
    public $date_time;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read() {
        // select all query
        $query = "SELECT p.id, p.stelling_id, p.partij_id, p.antwoord, p.date_time FROM "
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
         stelling_id=:stelling_id, partij_id=:partij_id, antwoord=:antwoord";
        // prepare query
        $stmt =  $this->conn->prepare($query);

        //sanitize query
        $this->stelling_id=htmlspecialchars(strip_tags($this->stelling_id));
        $this->partij_id=htmlspecialchars(strip_tags($this->partij_id));
        $this->antwoord=htmlspecialchars(strip_tags($this->antwoord));

        //bind values
        $stmt->bindparam(":stelling_id", $this->stelling_id);
        $stmt->bindparam(":partij_id", $this->partij_id);
        $stmt->bindparam(":antwoord", $this->antwoord);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function readone() {
        $query = "SELECT p.id, p.stelling_id, p.partij_id, p.antwoord, p.date_time FROM "
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
        if (!empty($row['stelling_id'])) {
            $this->stelling_id = $row['stelling_id'];
        }
        if (!empty($row['partij_id'])) {
            $this->partij_id = $row['partij_id'];
        }
        if (!empty($row['antwoord'])) {
            $this->antwoord = $row['antwoord'];
        }
    }
    // update the product
    function update(){
        // update query
        $query = "UPDATE 
        ". $this->table_name ."
            SET 
                stelling_id = :stelling_id, 
                partij_id = :partij_id,
                antwoord = :antwoord
            WHERE 
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->stelling_id=htmlspecialchars(strip_tags($this->stelling_id));
        $this->partij_id=htmlspecialchars(strip_tags($this->partij_id));
        $this->antwoord=htmlspecialchars(strip_tags($this->antwoord));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':stelling_id', $this->stelling_id);
        $stmt->bindParam(':partij_id', $this->partij_id);
        $stmt->bindParam(':antwoord', $this->antwoord);
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