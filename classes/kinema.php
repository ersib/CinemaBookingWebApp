<?php

require_once 'database.php';

class Kinema {
    private $conn;
    public $id;
    public $emri;
    public $adresa;
    public $tel;
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
        $res=$this->conn->query($sql);

        $row=$res->fetch_array();
        $this->id=$row['Id_kinema'];
        $this->emri=$row['Em_kinema'];
        $this->adresa=$row['Adresa'];
        $this->tel=$row['Telefoni'];
        return $this;
    }
    public function getCinemaByName($emri){
        $sql=" SELECT *
        FROM cinema2
        WHERE Em_kinema='$emri'";
        $res=$this->conn->query($sql);
        $row=$res->fetch_array();
        $this->id=$row['Id_kinema'];
        $this->emri=$row['Em_kinema'];
        $this->adresa=$row['Adresa'];
        $this->tel=$row['Telefoni'];
        return $this;
    }

    public function getAllCinemas(){
      $sql="SELECT * FROM cinema2";
      $res = $this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    public function getAllTheatres(){
      $sql="SELECT * FROM theaters2 WHERE JId_kinema='$this->id'";
      $res = $this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }

  // Insert
    public function insert($name,$adresa,$tel){
        $res = $this->conn->query("INSERT INTO cinema2 (Em_kinema,Adresa,Telefoni)
		VALUES('$name','$adresa', '$tel')");

		return $res;
    }

	// Update
    public function update($name,$adresa,$tel,$id){

        $res = $this->conn->query("UPDATE cinema2 SET Em_kinema='$name',Adresa='$adresa',Telefoni='$tel'
        WHERE Id_kinema='$id'");
        return $res;
    }
    // Delete
    public function delete($id){

        $res = $this->conn->query("DELETE FROM cinema2 WHERE Id_kinema = '$id'");
        return $res;
    }

    // Redirect URL method
    public function redirect($url)
	{
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
