<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/startup.php'; 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare startup object
$startup = new Startup($db);
 
// get id of startup to be edited
$data = json_decode(file_get_contents("php://input"));     
 

// read the details of startup to be edited
$startup->moreProblem();
 
// create array
$startup_arr[] = array(
    "name_problem"  => utf8_encode($startup->name_problem)
    );
 
// make it json format
print_r(json_encode($startup_arr));
?>