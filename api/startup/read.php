<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/startup.php';
include_once '../objects/problem.php';
// instantiate database and startup object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$startup = new Startup($db);
 
// query startup
$stmt = $startup->readAll();
$num = $stmt->rowCount();
 
$data="";
 
// check if more than 0 record found
if($num>0){
 
     
    $x=1;
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $data .= '{';
            $data .= '"id":"'  . $id . '",';
            $data .= '"name":'   . json_encode(utf8_encode($name_startup)) . ',';
            $data .= '"pitch":'   . json_encode(utf8_encode($pitch))  . ',';
            $data .= '"city":' . json_encode(utf8_encode($city)). ',';
            $data .= '"state":' . json_encode(utf8_encode($state)). ',';
            $data .= '"info":' . json_encode(utf8_encode($more_info)). ',';
            $data .= '"name_founder":' . json_encode(utf8_encode($name_founder)). ',';
            $data .= '"url_founder":' . json_encode(utf8_encode($url_founder)). ',';
            $data .= '"date_born":"' . $date_born. '",'; 
            $data .= '"date_fail":"' . $date_fail. '",';
            $data .= '"name_problem":' . json_encode(utf8_encode($name_problem)).',';
            $data .= '"investiment":"' . $investiment. '",';           
            $data .= '"date_include":"' . $date_include . '"';
        $data .= '}';
 
        $data .= $x<$num ? ',' : '';
 
        $x++;
    }
}
 
// json format output
echo '{"records":[' . $data . ']}';
?>