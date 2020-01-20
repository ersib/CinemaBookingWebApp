<?php
require_once('../dbconfig/config.php');
require_once 'database.php';

class Theater {
    private $conn;
    public $id;
    public $emri;
    public $tech;
    public $kapaciteti;
    public $Id_kinema;
    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }
    public function getAllTheatersByCinemId($cid){
      $sql="SELECT * FROM theaters2 WHERE JId_kinema='$cid'";
      $res = $this->conn->query($sql);
    //  $res->execute();
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }

    public function getTheaterById($s_id){
        $sql=" SELECT *
        FROM theaters2
        WHERE theaters2.Id_salla='$s_id'";
        $res=$this->conn->query($sql);
        //$res->execute();
        $row=$res->fetch_array();
        $this->id=$row['Id_salla'];
        $this->emri=$row['Em_salla'];
        $this->tech=$row['Teknologjia'];
        $this->kapaciteti=$row['Kapaciteti'];
        $this->Id_kinema=$row['JId_kinema'];
        return $this;
    }

    // Insert
    public function insert($name,$nseats,$tech,$idKinema){
        $res = $this->conn->query("INSERT INTO theaters2 (Em_salla,Kapaciteti,Teknologjia,JId_kinema)
		VALUES('$name','$nseats', '$tech','$idKinema')");

		//$res->execute();
    return $res;
    }

	// Update
    public function update($name,$nseats,$tech,$idKinema,$id){

        $res = $this->conn->query("UPDATE theaters2 SET Em_salla='$name',Kapaciteti='$nseats',Teknologjia='$tech',JId_kinema='$idKinema'
        WHERE Id_salla='$id'");
//$res->execute();
       return $res;
    }



    // Delete
    public function delete($id){
    //  try{
        $res = $this->conn->query("DELETE FROM theaters2 WHERE Id_salla = '$id'");
    //    $res->bindparam(":id", $id);
    //    $res->execute();
        return $res;
  //    }catch(PDOException $e){
  //        echo $e->getMessage();
  //    }
    }

    // Redirect URL method
    public function redirect($url)
	{
    //  header("Location: ".$url."");
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
