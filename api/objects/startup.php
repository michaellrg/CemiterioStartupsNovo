<?php 
class Startup{ 
    // database connection and table name 
    private $conn; 
    private $table_name = "startup"; 
 
    // object properties 
    public $id;
    public $name_startup; 
    public $pitch; 
    public $city; 
    public $state; 
    public $id_problem;
    public $more_info;
    public $name_founder;
    public $url_founder;
    public $date_born;
    public $date_fail;
    public $investiment;
    public $date_include;

    //Virtual var
    public $num_rows;
    public $name_problem;

 
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db;
    }

    function create(){
     
    // query to insert record
    $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                name_startup=:name_startup,pitch=:pitch ,city=:city, state=:state, id_problem=:id_problem, more_info=:more_info, 
                name_founder=:name_founder, url_founder=:url_founder, date_born=:date_born, date_fail=:date_fail, investiment=:investiment, id_status_startup=2";
     
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->name_startup=json_decode(utf8_decode($this->name_startup));
    $this->pitch=json_decode(utf8_decode($this->pitch));
    $this->city=json_decode(utf8_decode($this->city));
    $this->state=json_decode(utf8_decode($this->state));
    $this->more_info=json_decode(utf8_decode($this->more_info));
    $this->name_founder=json_decode(utf8_decode($this->name_founder));
    $this->url_founder=json_decode(utf8_decode($this->url_founder));
   

  
 
    // bind values
    $stmt->bindParam(":name_startup", $this->name_startup);
    $stmt->bindParam(":pitch", $this->pitch);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":state", $this->state);
    $stmt->bindParam(":id_problem", $this->id_problem);
    $stmt->bindParam(":more_info", $this->more_info);
    $stmt->bindParam(":name_founder", $this->name_founder);
    $stmt->bindParam(":url_founder", $this->url_founder);
    $stmt->bindParam(":date_born", $this->date_born);
    $stmt->bindParam(":date_fail", $this->date_fail);
    $stmt->bindParam(":investiment", $this->investiment);
  
     
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
                startup.id, name_startup, pitch, city, state, name_problem, more_info, name_founder, url_founder, date_born, date_fail, investiment
            FROM
                " . $this->table_name . "
                JOIN problem
                ON ".$this->table_name.
            ".id_problem = problem.id
            WHERE id_status_startup = 1
            ORDER BY
                startup.id";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // execute query
    $stmt->execute();

    return $stmt;
}

function readOne(){
 
    // select single record
    $query = "SELECT
                startup.id, name_startup, pitch, city, state, id_problem, name_problem, more_info, name_founder, url_founder, date_born, date_fail, investiment
            FROM
                " . $this->table_name .
                 " JOIN problem
                ON ".$this->table_name.
            ".id_problem = problem.id"
                .
                 " WHERE 
                startup.id = ?
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
    $this->name_startup = $row['name_startup'];
    $this->pitch = $row['pitch'];
    $this->city = $row['city'];
    $this->state = $row['state'];
    $this->id_problem = $row['id_problem'];
    $this->name_problem = $row['name_problem'];
    $this->more_info = $row['more_info'];
    $this->name_founder = $row['name_founder'];
    $this->url_founder = $row['url_founder'];
    $this->date_born = $row['date_born'];
    $this->date_fail = $row['date_fail'];
    $this->investiment = $row['investiment'];

}

// update the problem
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
             name_startup=:name_startup,pitch:pitch ,city:city, state:state, id_problem:id_problem, more_info:more_info, 
                name_founder:name_founder, url_founder:url_founder, date_born:date_born, date_fail:date_fail,investiment:investiment
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name_startup=htmlspecialchars(strip_tags($this->name_startup));
    $this->pitch=htmlspecialchars(strip_tags($this->pitch));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->state=htmlspecialchars(strip_tags($this->state));
    $this->more_info=htmlspecialchars(strip_tags($this->more_info));
    $this->name_founder=htmlspecialchars(strip_tags($this->name_founder));
    $this->url_founder=htmlspecialchars(strip_tags($this->url_founder));
    $this->investiment=htmlspecialchars(strip_tags($this->investiment));
    $this->id=htmlspecialchars(strip_tags($this->id));
	
    // bind new values
     // bind values
    $stmt->bindParam(":name_startup", $this->name_startup);
    $stmt->bindParam(":pitch", $this->pitch);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":state", $this->state);
    $stmt->bindParam(":id_problem", $this->id_problem);
    $stmt->bindParam(":more_info", $this->more_info);
    $stmt->bindParam(":name_founder", $this->name_founder);
    $stmt->bindParam(":url_founder", $this->url_founder);
    $stmt->bindParam(":date_born", $this->date_born);
    $stmt->bindParam(":date_fail", $this->date_fail);
    $stmt->bindParam(":investiment", $this->investiment);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}



// delete the startup
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


function totalStartup(){
 
    // select total query
    $query = "SELECT id, COUNT( * ) as n FROM " . $this->table_name . " WHERE id_status_startup = 1";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
 
    // execute query
    $stmt->execute();


    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->num_rows = $row['n'];
}

function moreCity(){
    // select total query
    $query = "SELECT city, COUNT( * ) n FROM ". $this->table_name." WHERE city IS NOT NULL AND id_status_startup = 1 GROUP BY city ORDER BY n DESC LIMIT 1 " ;
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
 
    // execute query
    $stmt->execute();


    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->city = $row['city'];
}

function moreProblem(){
    // select total query
    $query = "SELECT problem.name_problem, COUNT( * ) as n FROM ". $this->table_name." JOIN problem
                ON ". $this->table_name.".id_problem=problem.id WHERE `id_problem` != 6 AND id_status_startup = 1 ' GROUP BY `id_problem` ORDER BY n DESC LIMIT 1" ;
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
 
    // execute query
    $stmt->execute();

      // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->name_problem = $row['name_problem'];


}

function totalInvestiment(){
    // select total query
    $query = "SELECT SUM(investiment) FROM ". $this->table_name . " WHERE id_status_startup = 1";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
 
    // execute query
    $stmt->execute();

      // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->investiment = $row['SUM(investiment)'];


}
}
?>