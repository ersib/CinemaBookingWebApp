<?php

require_once 'database.php';

class Reklame {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

    // shton ne databaze
    public function insert($title,$desc,$img){
		$dataPublikimit=date("Y-m-d H:i:s");
        $res = $this->conn->query("INSERT INTO ads2 (Titulli_ads,Permbajtja,DataPublikimit,Imazh_ads)
		VALUES('$title', '$desc','$dataPublikimit','$img')");
        return $res;
    }

	// Update ne databaze
    public function update($title,$desc,$img,$aid){
        if($img == null)
				  $imazh=" ";
			  else
				  $imazh=", Imazh_ads='$img'";
        $res = $this->conn->query("UPDATE ads2 SET Titulli_ads='$title',Permbajtja='$desc' ".$imazh."
        WHERE Id_ads='$aid'");

		return $res;

    }

    public function getAllReklame(){
      $res = $this->conn->query("SELECT * FROM ads2 ");
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }


    // fshi ne databaze
    public function delete($id){
        $res = $this->conn->query("DELETE FROM ads2 WHERE Id_ads = '$id'");
        return $res;
    }
    public function getReklameMeID($id){
      $res = $this->conn->query("SELECT * FROM ads2 WHERE Id_ads='$id'");
      $row=$res->fetch_array();
      return $row;
    }


    // Redirect URL method
    public function redirect($url)
	{
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
