<?php

class politieke_richtingen
{
    // database connection en tabel naam
    /**
     * @var $conn PDO
     */
    private $conn;
    private $table_name = "politieke_richtingen";

    //properties
    public $id;
    public $partij_id;
    public $links;
    public $rechts;
    public $progressief;
    public $conservatief;
    public $date_time;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read() {
        // select all query
        $query = "SELECT p.id, p.partij_id, p.links, p.rechts, p.progressief, p.conservatief, p.date_time FROM "
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
         partij_id=:partij_id, links=:links, rechts=:rechts, progressief=:progressief, conservatief=:conservatief";
        // prepare query
        $stmt =  $this->conn->prepare($query);

        //sanitize query
        $this->partij_id=htmlspecialchars(strip_tags($this->partij_id));
        $this->links=htmlspecialchars(strip_tags($this->links));
        $this->rechts=htmlspecialchars(strip_tags($this->rechts));
        $this->progressief=htmlspecialchars(strip_tags($this->progressief));
        $this->conservatief=htmlspecialchars(strip_tags($this->conservatief));

        //bind values
        $stmt->bindparam(":partij_id", $this->partij_id);
        $stmt->bindparam(":links", $this->links);
        $stmt->bindparam(":rechts", $this->rechts);
        $stmt->bindparam(":progressief", $this->progressief);
        $stmt->bindparam(":conservatief", $this->conservatief);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function readone() {
        $query = "SELECT p.id, p.partij_id, p.links, p.rechts, p.progressief, p.conservatief, p.date_time FROM "
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
        if (!empty($row['partij_id'])) {
            $this->partij_id = $row['partij_id'];
        }
        if (!empty($row['links'])) {
            $this->links = $row['links'];
        }
        if (!empty($row['rechts'])) {
            $this->rechts = $row['rechts'];
        }
        if (!empty($row['progressief'])) {
            $this->progressief = $row['conservatief'];
        }
        if (!empty($row['conservatief'])) {
            $this->conservatief = $row['conservatief'];
        }
    }
    // update the product
    function update(){
        // update query
        $query = "UPDATE 
        ". $this->table_name ."
            SET 
                partij_id = :partij_id, 
                links = :links,
                rechts = :rechts,
                progressief = :progressief,
                conservatief = :conservatief
            WHERE 
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->partij_id=htmlspecialchars(strip_tags($this->partij_id));
        $this->links=htmlspecialchars(strip_tags($this->links));
        $this->rechts=htmlspecialchars(strip_tags($this->rechts));
        $this->progressief=htmlspecialchars(strip_tags($this->progressief));
        $this->conservatief=htmlspecialchars(strip_tags($this->conservatief));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':partij_id', $this->partij_id);
        $stmt->bindParam(':links', $this->links);
        $stmt->bindParam(':rechts', $this->rechts);
        $stmt->bindParam(':progressief', $this->progressief);
        $stmt->bindParam(':conservatief', $this->conservatief);
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
