<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/startup.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate startup object
$startup = new Startup($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set ID property of startup to be edited

$startup->id = $data->id; 

// set startup property values
$startup->name_startup= $data->name;
$startup->pitch = $data->pitch;
$startup->city = $data->city;
$startup->state = $data->state;
$startup->id_problem = $data->problem;
$startup->more_info= $data->info;
$startup->name_founder = $data->name_founder;
$startup->url_founder = $data->url_founder;
$startup->date_born = $data->date_born;
$startup->date_fail = $data->date_fail;
$startup->investiment = $data->investiment;
$startup->date_include = date('Y-m-d H:i:s');

// update the startup
if($startup->update()){
    echo "Startup was updated.";
}
 
// if unable to update the startup, tell the user
else{
    echo "Unable to update startup.";
}
?>