<?php 
// include database and object file 
include_once '../config/database.php'; 
include_once '../objects/startup.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare startup object
$startup = new Startup($db);
 
// get startup id
$data = json_decode(file_get_contents("php://input"));     
 
// set startup id to be deleted
$startup->id = $data->id;
 
// delete the startup
if($startup->delete()){
    echo "Startup was deleted.";
}
 
// if unable to delete the startup
else{
    echo "Unable to delete object.";
}
?>