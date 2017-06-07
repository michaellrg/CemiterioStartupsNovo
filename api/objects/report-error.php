<?php 
    class ReportError
    { 
        // database connection and table name 
        private $conn; 
        private $table_name = "report_error"; 
    
        // object properties 
        public $id;
        public $is_bug;
        public $id_startup; 
        public $more_info;
        public $error_field;
        public $date_include;
        public $email;
        //aux name field
        public $startup_name;

        // constructor with $db as database connection 
        public function __construct($db){ 
            $this->conn = $db;
        }

        function create()
        {
            // query to insert record
            $query = "INSERT INTO 
                        " . $this->table_name . "
                    SET 
                        is_bug=:is_bug,id_startup=:id_startup ,more_info=:more_info, error_field=:error_field, email=:email";
            
            // prepare query
            $stmt = $this->conn->prepare($query);
        
            // posted values
            $this->is_bug=json_decode(utf8_decode($this->is_bug));
            $this->id_startup=json_decode(utf8_decode($this->id_startup));
            $this->more_info=json_decode(utf8_decode($this->more_info));
            $this->error_field=json_decode(utf8_decode($this->error_field));
            $this->email=json_decode(utf8_decode($this->email));
        
            // bind values
            $stmt->bindParam(":is_bug", $this->is_bug);
            $stmt->bindParam(":id_startup", $this->id_startup);
            $stmt->bindParam(":more_info", $this->more_info);
            $stmt->bindParam(":error_field", $this->error_field);
            $stmt->bindParam(":email", $this->email);
            
            // execute query
            if($stmt->execute()) {
                return true;
            } else {
                echo "<pre>";
                    print_r($stmt->errorInfo());
                echo "</pre>";
        
                return false;
            }
        }
    }
?>