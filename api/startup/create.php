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
 
// set startup property values
$startup->name_startup= $data->name_startup;
$startup->pitch = $data->pitch;
$startup->city = $data->city;
$startup->state = $data->state;
$startup->id_problem = $data->id_problem;
$startup->more_info= $data->more_info;
$startup->name_founder = $data->name_founder;
$startup->url_founder = $data->url_founder;
$startup->date_born = $data->date_born;
$startup->date_fail = $data->date_fail;
$startup->investiment = $data->investiment;
$startup->date_include = date('Y-m-d H:i:s');

// create the startup
if($startup->create()){
    echo "Startup was created.";
}
 
// if unable to create the startup, tell the user
else{
    echo "Unable to create startup.";
}
?>