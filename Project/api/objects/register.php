<?php 
class register{
 
    // database connection and table name
    private $conn;
    private $table_name = "register";
 
    // object properties
    public $uniqueId;
    public $name;
    public $contact;
    public $username;
    public $password;
    
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function read(){
 
    // select all query
    $query = "SELECT * FROM register";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
        }
    };
?>