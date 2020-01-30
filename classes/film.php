<?php
require_once 'database.php';
require_once 'shfaqje.php';

class Film {
    private $conn;
    public $filmId;
    public $titulli;
    public $data;
    public $koha;
    public $zhanri;
    public $kasti;
    public $desc;
    public $regj;
    public $url;
    public $imazh;
    public $poster;

    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

    public function insert( $movname,$movDate,$movTime,$movGenre, $movCast, $movDesc,$movDir,$movURL,$fp,$Wimg){
       $this->conn->query("INSERT INTO movies2 VALUES('','$movname','$movDate','$movTime','$movGenre',' $movCast', '$movDesc','$movDir','$movURL','$fp','$Wimg')");
        return $result;
    }
    public function update($movname,$movDate,$movTime,$movGenre, $movCast, $movDesc,$movDir,$movURL,$fp,$Wimg,$mid){

		  if($movDate!=null){
			  if($fp == null)
				  $posteri=" ";
			  else
				  $posteri=", Imazhi_film='$fp'";
			  if($Wimg == null)
				  $wall=" ";
			  else
				  $wall=", Imazh_wall='$Wimg'";
          $result = $this->conn->query("UPDATE movies2 SET Titull_film='$movname',Data_fillimit='$movDate',Kohezgjatja='$movTime',Zhanri='$movGenre',Kasti='$movCast',Pershkrim='$movDesc',Regjisori='$movDir', TrailerUrl='$movURL'".$posteri."  ".$wall." WHERE Id_film='$mid'");
		  }
		  else if($movDate==null){
			 if($fp == null)
				  $posteri=" ";
			  else
				  $posteri=", Imazhi_film='$fp'";
			  if($Wimg == null)
				  $wall=" ";
			  else
				  $wall=", Imazh_wall='$Wimg'";
		 $result = $this->conn->query("UPDATE movies2 SET Titull_film='$movname', Kohezgjatja='$movTime',Zhanri='$movGenre',Kasti='$movCast'
		 ,Pershkrim='$movDesc',Regjisori='$movDir',TrailerUrl='$movURL' ".$posteri."  ".$wall."
		 WHERE Id_film='$mid'");
		 }

		if(!$result)
			echo '<script>alert("Ka gabim sql")</script>';
        return $result;
    }


    public function delete($id){
        $res = $this->conn->query("DELETE FROM movies2 WHERE Id_film = '$id'");
        return $res;
    }

    public function redirect($url){
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }

    public function getAllFilms(){
      $sql="SELECT * FROM movies2";
      $result=$this->conn->query($sql);
      if(!$result)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$result->fetch_all(MYSQLI_ASSOC);
      return $row;
    }

    public function getAllFilmsWithShows(){
      $shfaqje=new Shfaqje();
      $shfaqje->updateStatusOfShows();
      $free_seats='Free seats';
      $sql="SELECT DISTINCT movies2.Titull_film,movies2.Imazhi_film,movies2.Id_film FROM movies2 INNER JOIN shows2 ON shows2.JId_film=movies2.Id_film WHERE shows2.Status='$free_seats'";
      $res=$this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    public function getFilmById($id){
      $res=$this->conn->query("select * from movies2 where Id_film='$id'");

      if($row=$res->fetch_array()){
        $this->filmId=$row['Id_film'];
        $this->titulli=$row['Titull_film'];
        $this->data=$row['Data_fillimit'];
        $this->koha=$row['Kohezgjatja'];;
        $this->zhanri=$row['Zhanri'];
        $this->kasti=$row['Kasti'];
        $this->desc=$row['Pershkrim'];
        $this->regj=$row['Regjisori'];
        $this->url=$row['TrailerUrl'];
        $this->imazh=$row['Imazhi_film'];
        $this->poster=$row['Imazh_wall'];
       return $this;
      }
      else {
        return null;
      }
    }
    // Kthen te gjitha kinemate ne te cilat shfaqet ky film
    public function availableCinemas(){
      $fid=$this->filmId;
      $sql=" SELECT DISTINCT cinema2.Em_kinema,cinema2.Id_kinema
      FROM cinema2
      INNER JOIN theaters2 ON cinema2.Id_kinema=theaters2.JId_kinema
      INNER JOIN shows2 ON theaters2.Id_salla=shows2.JId_salla
      WHERE shows2.JId_film='$fid'";

      $res=$this->conn->query($sql);
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
      // Kthen te gjitha sallat ne te cilat shfaqet ky film
    public function availableTheatres($cid){
        $fid=$this->filmId;

        $sql=" SELECT DISTINCT theaters2.Id_salla,theaters2.Em_salla,theaters2.Teknologjia
        FROM theaters2
        INNER JOIN shows2 ON theaters2.Id_salla=shows2.JId_salla
        WHERE shows2.JId_film='$fid' AND theaters2.JId_kinema='$cid' AND shows2.Status='Free seats'";
        $res=$this->conn->query($sql);
        $row=$res->fetch_all(MYSQLI_ASSOC);
        return $row;
    }
    // Kthen te gjitha data ne te cilat shfaqet ky film
    public function availableDates($s_id){
      $data_sot=date("Y-m-d");
        $fid=$this->filmId;
        $sql=" SELECT DISTINCT shows2.Data_sh
        FROM shows2
        WHERE shows2.JId_film='$fid' AND shows2.JId_salla='$s_id' AND shows2.Data_sh > '$data_sot'";
        $res=$this->conn->query($sql);
        $row=$res->fetch_all(MYSQLI_BOTH);
        return $row;
    }
    // Kthen te gjitha oraret ne te cilat shfaqet ky film
    public function availableTimes($s_id,$data){
        $fid=$this->filmId;
        $sql=" SELECT DISTINCT shows2.Ora_sh
        FROM shows2
        WHERE shows2.JId_film='$fid' AND shows2.JId_salla='$s_id' AND shows2.Data_sh='$data'";
        $res=$this->conn->query($sql);
        $row=$res->fetch_all(MYSQLI_BOTH);
        return $row;
    }

    public function getFilmByTitle($titulli){
      $res=$this->conn->query("SELECT * FROM movies2 WHERE Titull_film='$titulli'");

      if($row=$res->fetch_array()){
        $this->filmId=$row['Id_film'];
        $this->titulli=$row['Titull_film'];
        $this->data=$row['Data_fillimit'];
        $this->koha=$row['Kohezgjatja'];;
        $this->zhanri=$row['Zhanri'];
        $this->kasti=$row['Kasti'];
        $this->desc=$row['Pershkrim'];
        $this->regj=$row['Regjisori'];
        $this->url=$row['TrailerUrl'];
        $this->imazh=$row['Imazhi_film'];
       return $this;
      }
      else {
        return null;
      }
    }

}
?>
