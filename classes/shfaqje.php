<?php
//require_once('../dbconfig/config.php');
require_once 'database.php';

class Shfaqje {

    private $conn;
    public $id;
    public $data;
    public $ora;
    public $cmimi;
    public $vendet_rez;
    public $Id_salla;
    public $Id_film;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

    public function getShowById($showid){
        $sql=" SELECT *
        FROM shows2
        WHERE shows2.Id_shfaqje='$showid'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch();
        $this->id=$row['Id_shfaqje'];
        $this->data=$row['Data_sh'];
        $this->ora=$row['Ora_sh'];
        $this->cmimi=$row['Cmimi'];
        $this->vendet_rez=$row['VendeRez'];
        $this->Id_salla=$row['JId_salla'];
        $this->Id_film=$row['JId_film'];
        return $this;
    }

    public function getShow($s_id,$data,$ora,$fid){
        $sql=" SELECT *
        FROM shows2
        WHERE shows2.JId_film='$fid' AND shows2.JId_salla='$s_id' AND shows2.Data_sh='$data' AND shows2.Ora_sh";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch();
        $show=new Shfaqje();
        $this->id=$row['Id_shfaqje'];
        $this->data=$row['Data_sh'];
        $this->ora=$row['Ora_sh'];
        $this->cmimi=$row['Cmimi'];
        $this->vendet_rez=$row['VendeRez'];
        $this->Id_salla=$row['JId_salla'];
        $this->Id_film=$row['JId_film'];
        return $this;
    }
    public function soldOut(){
      $sql=" SELECT shows2.VendeRez , theaters2.Kapaciteti
      FROM shows2
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      WHERE shows2.Id_shfaqje='$this->id'";
      $stmt=$this->conn->prepare($sql);
      $stmt->execute();
      $row=$stmt->fetch();
      if($row['VendeRez']>=$row['Kapaciteti']){
      return true;
      }
      else {
        return false;
      }
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
