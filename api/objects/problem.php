<?php 
class Problem{ 
    // database connection and table name 
    private $conn; 
    private $table_name = "problem"; 
 
    // object properties 
    public $id;
    public $name_problem; 
    


 
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db;
    }


    // create problem
function create(){
     
    // query to insert record
    $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                name_problem=:name_problem";
     
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->name_problem=htmlspecialchars(strip_tags($this->name_problem));
   
 
    // bind values
    $stmt->bindParam(":name_problem", $this->name_problem);
  
     
    // execute query
    if($stmt->execute()){
        return true;
    }else{
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
 
        return false;
    }
}

// read products
function readAll(){
 
    // select all query
    $query = "SELECT
               `id`, `name_problem`
            FROM
                " . $this->table_name . "
           
				ORDER BY`id`";
 
     // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // execute query
    $stmt->execute();

    return $stmt;
}

function readOne(){
     
    // query to read single record
    $query = "SELECT 
              id, name_problem
            FROM 
                " . $this->table_name . "
            WHERE 
                id = ? 
            LIMIT 
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
     
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
     
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // set values to object properties
    $this->name = $row['name_problem'];
   
}

// update the problem
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                  name_problem=:name_problem
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name_problem=htmlspecialchars(strip_tags($this->name_problem));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':name_problem', $this->name_problem);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

// delete the problem
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}



}
?>