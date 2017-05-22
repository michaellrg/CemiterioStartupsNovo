<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/problem.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate problem object
$startup = new Problem($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID problem
$problem ->id = $data->id;

// set problem property values
$problem->name_problem= $data->name;


// update the problem
if($problem->update()){
    echo "Problem was updated.";
}
 
// if unable to update the problem, tell the user
else{
    echo "Unable to update problem.";
}
?>