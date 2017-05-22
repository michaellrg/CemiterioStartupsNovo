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
 
// set problem property values
$problem->name_problem= $data->name;


// create the problem
if($problem->create()){
    echo "Problem was created.";
}
 
// if unable to create the problem, tell the user
else{
    echo "Unable to create problem.";
}
?>