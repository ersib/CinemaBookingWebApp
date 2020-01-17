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

    public function isValidShowTime($DitaSH,$KohaSH,$SallaID){
      $sql="SELECT * FROM shows2 WHERE JId_salla=:sid and Ora_sh=:ora and Data_sh=:dita";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindparam(":sid", $SallaID);
      $stmt->bindparam(":ora", $KohaSH);
      $stmt->bindparam(":dita", $DitaSH);
      $stmt->execute();
      if($stmt->fetch())
      return false;
      else
      return true;
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

    public function updateStatusOfShows(){
      $sql=" SELECT shows2.VendeRez , theaters2.Kapaciteti , shows2.Id_shfaqje , shows2.Data_sh
      FROM shows2
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla";
      $stmt=$this->conn->prepare($sql);
      $stmt->execute();
      $row=$stmt->fetchAll();
      $data_sot=date("Y-m-d");
      for($i=0;$i<count($row);$i++){
          $id=$row[$i]['Id_shfaqje'];
        if($row[$i]['Data_sh']<$data_sot){
          $sql=" UPDATE shows2 SET Status='Old show'
          WHERE Id_shfaqje='$id'";
          $stmt=$this->conn->prepare($sql);
          $stmt->execute();
        }
        else if($row[$i]['VendeRez']>=$row[$i]['Kapaciteti']){
        $sql=" UPDATE shows2 SET Status='Sold out'
        WHERE Id_shfaqje='$id'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
      }
       else {
         $sql=" UPDATE shows2 SET Status='Free seats'
         WHERE Id_shfaqje='$id'";
         $stmt=$this->conn->prepare($sql);
         $stmt->execute();
       }
     }
   }
   public function getAllShowsByMovie($title){
     $sql="SELECT shows2.Id_shfaqje,
      shows2.Data_sh,
      shows2.Ora_sh ,
      shows2.Cmimi,
      shows2.VendeRez,
      movies2.Titull_film,
      cinema2.Em_kinema,
      theaters2.Em_salla,
      shows2.Status
        FROM shows2
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      INNER JOIN movies2 ON movies2.Id_film=shows2.JId_film
      INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
      WHERE movies2.Titull_film=:titull";

     $stmt = $this->conn->prepare($sql);
     $stmt->bindparam(":titull",$title);
     $stmt->execute();
     if(!$stmt)
     echo '<script>alert("Ga gabim ne DB")</script>';
     $row=$stmt->fetchAll();
     return $row;
   }

    public function getAllShows(){
      $this->updateStatusOfShows();
      $sql="SELECT shows2.Id_shfaqje,
       shows2.Data_sh,
       shows2.Ora_sh ,
       shows2.Cmimi,
       shows2.VendeRez,
       movies2.Titull_film,
       cinema2.Em_kinema,
       theaters2.Em_salla,
              shows2.Status
         FROM shows2
                           INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
                           INNER JOIN movies2 ON movies2.Id_film=shows2.JId_film
         INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema";

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      if(!$stmt)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$stmt->fetchAll();
      return $row;
    }
    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($DitaSH,$KohaSH,$cmimi,$vendeR,$status,$SallaID,$filmID){
         $sql="insert into shows2 values('','$DitaSH','$KohaSH','$cmimi','$vendeR','$status','$SallaID','$filmID')";
         $stmt=$this->conn->prepare($sql);
         $stmt->execute();
         return $stmt;
    }

	// Update
    public function update($name,$nseats,$tech,$idKinema,$id){
    $stmt = $this->conn->prepare("UPDATE theaters2 SET Em_salla='$name',Kapaciteti='$nseats',Teknologjia='$tech',JId_kinema='$idKinema'WHERE Id_salla='$id'");
    $stmt->execute();
    }



    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM shows2 WHERE Id_shfaqje = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // Redirect URL method
    public function redirect($url){
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
