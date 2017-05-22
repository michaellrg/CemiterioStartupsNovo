<?php 
// include database and object file 
include_once '../config/database.php'; 
include_once '../objects/problem.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare problem object
$problem = new Problem($db);
 
// get problem id
$data = json_decode(file_get_contents("php://input"));     
 
// set problem id to be deleted
$problem->id = $data->id;
 
// delete the problem
if($problem->delete()){
    echo "Problem was deleted.";
}
 
// if unable to delete the problem
else{
    echo "Unable to delete object.";
}
?>