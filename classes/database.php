<?php
class Database {
  
    private $host = "localhost";
    private $dbName = "cinemadb";
    private $username = "root";
    private $password = "";

    public $conn;

    public function dbConnection() {
        $this->conn=new mysqli("localhost","root","","cinemadb");
        return $this->conn;
    }
}

?>
