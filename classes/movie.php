<?php
//require_once('../dbconfig/config.php');
require_once 'database.php';

class Movie {
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
    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

  public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }


    // Insert
    public function insert( $movname,$movDate,$movTime,$movGenre, $movCast, $movDesc,$movDir,$movURL,$fp,$Wimg){
     // try{
        $stmt = $this->conn->prepare("INSERT INTO movies2
		VALUES('','$movname','$movDate','$movTime','$movGenre',' $movCast', '$movDesc','$movDir','$movURL','$fp','$Wimg')");


		$stmt->execute();
        //return $stmt;
      //}catch(PDOException $e){echo $e->getMessage();}
    }

	// Update
    public function update($movname,$movDate,$movTime,$movGenre, $movCast, $movDesc,$movDir,$movURL,$fp,$Wimg,$mid){

    // echo '<script>alert("Po behet update")</script>';
		  if($movDate!=null)
		  {
			  if($fp == null)
				  $posteri=" ";
			  else
				  $posteri=", Imazhi_film='$fp'";
			  if($Wimg == null)
				  $wall=" ";
			  else
				  $wall=", Imazh_wall='$Wimg'";
        $stmt = $this->conn->prepare("UPDATE movies2
		SET Titull_film='$movname',Data_fillimit='$movDate',Kohezgjatja='$movTime',
	    Zhanri='$movGenre',Kasti='$movCast',Pershkrim='$movDesc',Regjisori='$movDir', TrailerUrl='$movURL'".$posteri."  ".$wall."
		WHERE Id_film='$mid'");
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
		 $stmt = $this->conn->prepare("UPDATE movies2 SET Titull_film='$movname', Kohezgjatja='$movTime',Zhanri='$movGenre',Kasti='$movCast'
		 ,Pershkrim='$movDesc',Regjisori='$movDir',TrailerUrl='$movURL' ".$posteri."  ".$wall."
		 WHERE Id_film='$mid'");
		 }

		$result=$stmt->execute();

		if(!$result)
			echo '<script>alert("Ka gabim sql")</script>';

		//else
          //echo '<script>alert("NUk ka gabim sql")</script>';
    }

    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM movies2 WHERE Id_film = :id");
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
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
    public function getAllMovies(){
      $sql="SELECT * FROM movies2";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      if(!$stmt)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$stmt->fetchAll();
      return $row;
    }
    public function getMovieById($id){
      $stmt=$this->conn->prepare("select * from movies2 where Id_film='$id'");
      $stmt->execute();
      if($row=$stmt->fetch()){
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
        echo '<script type="text/javascript">alert("Ka probleme ne sql")</script>';
      }
    }
    public function availableCinemas(){
      $fid=$this->filmId;
      $sql=" SELECT DISTINCT cinema2.Em_kinema,cinema2.Id_kinema
      FROM cinema2
      INNER JOIN theaters2 ON cinema2.Id_kinema=theaters2.JId_kinema
      INNER JOIN shows2 ON theaters2.Id_salla=shows2.JId_salla
      WHERE shows2.JId_film='$fid'";

      $stmt=$this->conn->prepare($sql);
      $stmt->execute();
      $row=$stmt->fetchAll();
      return $row;
    }
    public function availableTheaters($cid){
        $fid=$this->filmId;
        $sql=" SELECT DISTINCT theaters2.Id_salla,theaters2.Em_salla,theaters2.Teknologjia
        FROM theaters2
        INNER JOIN shows2 ON theaters2.Id_salla=shows2.JId_salla
        WHERE shows2.JId_film='$fid' AND theaters2.JId_kinema='$cid'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetchAll();
        return $row;
    }
    public function availableDates($s_id){
        $fid=$this->filmId;
        $sql=" SELECT DISTINCT shows2.Data_sh
        FROM shows2
        WHERE shows2.JId_film='$fid' AND shows2.JId_salla='$s_id'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetchAll();
        return $row;
    }
    public function availableTimes($s_id,$data){
        $fid=$this->filmId;
        $sql=" SELECT DISTINCT shows2.Ora_sh
        FROM shows2
        WHERE shows2.JId_film='$fid' AND shows2.JId_salla='$s_id' AND shows2.Data_sh='$data'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetchAll();
        return $row;
    }

    public function getMovieByTitle($titulli){
      $stmt=$this->conn->prepare("SELECT * FROM movies2 WHERE Titull_film='$titulli'");
      $stmt->execute();
      if($row=$stmt->fetch()){
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
        echo '<script type="text/javascript">alert("This title does not exist !")</script>';
        return null;
      }
    }

}
?>
