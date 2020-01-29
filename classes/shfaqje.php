<?php
//
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
        $res=$this->conn->query($sql);

        $row=$res->fetch_array();
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
      $sql="SELECT * FROM shows2 WHERE JId_salla='$SallaID' and Ora_sh='$KohaSH' and Data_sh='$DitaSH'";
      $res = $this->conn->query($sql);
      if($res->num_rows>0)
      return false;
      else
      return true;
    }

   // Perckton shfaqjen kur kemi te njohur daten dhe oren , sallen dhe filmin
    public function getShow($s_id,$data,$ora,$fid){
        $sql=" SELECT * FROM shows2 WHERE shows2.JId_film='$fid' AND shows2.JId_salla='$s_id' AND shows2.Data_sh='$data' AND shows2.Ora_sh";
        $res=$this->conn->query($sql);

        $row=$res->fetch_array();
        $this->id=$row['Id_shfaqje'];
        $this->data=$row['Data_sh'];
        $this->ora=$row['Ora_sh'];
        $this->cmimi=$row['Cmimi'];
        $this->vendet_rez=$row['VendeRez'];
        $this->Id_salla=$row['JId_salla'];
        $this->Id_film=$row['JId_film'];
        return $this;
    }
    // Kontrollon nqs vendet e rezervuar ne kete shfaqje kane arritur kapacitetin e salles ku do zhvillohet shfaqja e filmit
    public function soldOut(){
      $sql=" SELECT shows2.VendeRez , theaters2.Kapaciteti FROM shows2
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      WHERE shows2.Id_shfaqje='$this->id'";
      $res=$this->conn->query($sql);

      $row=$res->fetch_array();
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
      $res=$this->conn->query($sql);
    $row=$res->fetch_all(MYSQLI_ASSOC);
      $data_sot=date("Y-m-d");
      for($i=0;$i<count($row);$i++){
          $id=$row[$i]['Id_shfaqje'];
        if($row[$i]['Data_sh']<$data_sot){
          $sql=" UPDATE shows2 SET Status='Old show'WHERE Id_shfaqje='$id'";
          $this->conn->query($sql);
        }
        else if($row[$i]['VendeRez']>=$row[$i]['Kapaciteti']){
           $sql=" UPDATE shows2 SET Status='Sold out'WHERE Id_shfaqje='$id'";
           $this->conn->query($sql);
          ;
        }
       else {
         $sql=" UPDATE shows2 SET Status='Free seats'
         WHERE Id_shfaqje='$id'";
         $this->conn->query($sql);

       }
     }
   }
   // kthen te gjitha shfaqjet e organizuara per nje titull filmi
   public function getAllShowsByFilm($title){
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
      WHERE movies2.Titull_film='$title'";

     $res = $this->conn->query($sql);
    // $res->bindparam(":titull",$title);

     if(!$res)
     echo '<script>alert("Ga gabim ne DB")</script>';

     $row=$res->fetch_all(MYSQLI_BOTH);
     return $row;
   }
// kthen te gjitha shfaqjet e organizuara
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
        INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
        ORDER BY shows2.Data_sh DESC
        ";

      $res = $this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }

    // Insert
    public function insert($DitaSH,$KohaSH,$cmimi,$vendeR,$status,$SallaID,$filmID){
         $sql="insert into shows2 values('','$DitaSH','$KohaSH','$cmimi','$vendeR','$status','$SallaID','$filmID')";
         $res=$this->conn->query($sql);

         return $res;
    }

	// Update
    public function update($name,$nseats,$tech,$idKinema,$id){
      $res = $this->conn->query("UPDATE theaters2 SET Em_salla='$name',Kapaciteti='$nseats',Teknologjia='$tech',JId_kinema='$idKinema'WHERE Id_salla='$id'");
  ;
      return $res;
    }



    // Delete
    public function delete($id){
      //try{
        $res = $this->conn->query("DELETE FROM shows2 WHERE Id_shfaqje = '$id'");
        return $res;
    }

    public function redirect($url){
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
