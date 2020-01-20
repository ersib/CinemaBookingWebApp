<?php
require_once('../dbconfig/config.php');
require_once 'database.php';

class Ads {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }



    // Insert
    public function insert($title,$desc,$img){
		$dataPublikimit=date("Y-m-d H:i:s");
        $res = $this->conn->query("INSERT INTO ads2 (Titulli_ads,Permbajtja,DataPublikimit,Imazh_ads)
		VALUES('$title', '$desc','$dataPublikimit','$img')");
        return $res;
		//$res->execute();
    }

	// Update
    public function update($title,$desc,$img,$aid){
        if($img == null)
				  $imazh=" ";
			  else
				  $imazh=", Imazh_ads='$img'";
        $res = $this->conn->query("UPDATE ads2 SET Titulli_ads='$title',Permbajtja='$desc' ".$imazh."
        WHERE Id_ads='$aid'");

		return $res;

    }



    // Delete
    public function delete($id){
    //  try{
        $res = $this->conn->query("DELETE FROM ads2 WHERE Id_ads = '$id'");
    //    $res->bindparam(":id", $id);
    //    $res->execute();
        return $res;
    //  }catch(PDOException $e){
    //      echo $e->getMessage();
    //  }
    }

    // Redirect URL method
    public function redirect($url)
	{
    //  header("Location: ".$url."");
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
