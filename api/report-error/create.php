<?php
    // include database and object file
    include_once '../config/database.php';
    include_once '../objects/report-error.php';
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // instantiate Report error object
    $reportError = new ReportError($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    var_dump($data);
    die();
    
    $to      = 'nobody@example.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
?> 