<?php 
// include database and object files 
include_once '../config/database.php'; 
include_once '../objects/startup.php'; 
include_once '../objects/problem.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare startup object
$startup = new Startup($db);
 
// get id of startup to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of startup to be edited
$startup->id = $data->id;
 
// read the details of startup to be edited
$startup->readOne();
 
// create array
$startup_arr[] = array(
    "id"            => $startup ->id,
    "name_problem"  => utf8_encode($startup ->name_problem),
    "name"          => utf8_encode($startup ->name_startup),
    "pitch"         => utf8_encode($startup ->pitch),
    "city"          => utf8_encode($startup ->city),
    "state"         => utf8_encode($startup ->state),
    "info"          => utf8_encode($startup ->more_info),
    "name_founder"  => utf8_encode($startup ->name_founder),
    "url_founder"   => utf8_encode($startup ->url_founder),
    "date_born"     => $startup ->date_born,
    "date_fail"     => $startup ->date_fail,
    "investiment"   => $startup ->investiment
    );
 
// make it json format
print_r(json_encode($startup_arr));
?>