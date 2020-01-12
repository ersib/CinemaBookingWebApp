<?php
require_once('../dbconfig/config.php');
require_once 'database.php';

class Cinema {
    private $conn;
    public $id;
    public $emri;
    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

    public function getCinemaById($id){
        $sql=" SELECT *
        FROM cinema2
        WHERE Id_kinema='$id'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch();
        $this->id=$row['Id_kinema'];
        $this->emri=$row['Em_kinema'];
        return $this;
    }

    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($name,$adresa,$tel){
        $stmt = $this->conn->prepare("INSERT INTO cinema2 (Em_kinema,Adresa,Telefoni)
		VALUES('$name','$adresa', '$tel')");

		$stmt->execute();
    }

	// Update
    public function update($name,$adresa,$tel,$id){

        $stmt = $this->conn->prepare("UPDATE cinema2 SET Em_kinema='$name',Adresa='$adresa',Telefoni='$tel'
        WHERE Id_kinema='$id'");

		$stmt->execute();

    }



    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM cinema2 WHERE Id_kinema = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // Redirect URL method
    public function redirect($url)
	{
    //  header("Location: ".$url."");
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
