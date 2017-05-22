<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/problem.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare problem object
$problem = new Problem($db);
 
// get id of problem to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of problem to be edited
$problem->id = $data->id;
 
// read the details of problem to be edited
$problem->readOne();
 
// create array
$problem_arr[] = array(
    "id" =>  $problem->id,
    "name" => $problem->name_problem
);
 
// make it json format
print_r(json_encode($problem_arr));
?>