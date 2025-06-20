<?php
class dbconnection {
    private $localhost = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "students_crud";
    public $connection;
    
    public function __construct()
    {
        $this->connection = $this->connectDb();
    }
    public function connectDb(){
        $connection = mysqli_connect($this->localhost,$this->user,$this->password,$this->database);
        return $connection;
    }
}
    
?> 