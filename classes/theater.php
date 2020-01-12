<?php
require_once('../dbconfig/config.php');
require_once 'database.php';

class Theater {
    private $conn;
    public $id;
    public $emri;
    public $tech;
    public $Id_kinema;
    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }
    public function getTheaterById($s_id){
        $sql=" SELECT *
        FROM theaters2
        WHERE theaters2.Id_salla='$s_id'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch();
        $this->id=$row['Id_salla'];
        $this->emri=$row['Em_salla'];
        $this->tech=$row['Teknologjia'];
        $this->Id_kinema=$row['JId_kinema'];
        return $this;
    }

    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($name,$nseats,$tech,$idKinema){
        $stmt = $this->conn->prepare("INSERT INTO theaters2 (Em_salla,Kapaciteti,Teknologjia,JId_kinema)
		VALUES('$name','$nseats', '$tech','$idKinema')");

		$stmt->execute();
    }

	// Update
    public function update($name,$nseats,$tech,$idKinema,$id){

        $stmt = $this->conn->prepare("UPDATE theaters2 SET Em_salla='$name',Kapaciteti='$nseats',Teknologjia='$tech'
		,JId_kinema='$idKinema'
        WHERE Id_salla='$id'");

		$stmt->execute();

    }



    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM theaters2 WHERE Id_salla = :id");
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
