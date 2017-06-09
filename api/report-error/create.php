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

    // object validation
    if(!isset($data->is_bug))
        $data->is_bug = 'f';

    if(!isset($data->id_startup))
        $data->id_startup = 0;

    // set reporterror property values
    $reportError->is_bug= $data->is_bug;
    $reportError->id_startup = $data->id_startup;
    $reportError->more_info = $data->more_info;
    $reportError->email = $data->email;
    $reportError->startup_name = $data->startup_name;
    $reportError->date_include = date('Y-m-d H:i:s');

    // create the Report Error
    if($reportError->create()){
        //Send e-mail
        $to      = 'victor.am.ccomp@gmail.com';
        $subject = '[Cemitério de Startups] Erro Reportado!';
        $message = 'Olá! Um erro foi reportado por ' . $reportError->email . ' na Startup de ID #' . $reportError->id_startup . '.' .
                   '\n INFORMAÇÕES ' . 
                   '\n' . $reportError->more_info . '\n';
        $headers = 'From: '. $reportError->email . "\r\n" .
            'Reply-To: victor.am.ccomp@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }
?> 