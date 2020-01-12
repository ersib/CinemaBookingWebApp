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


    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($title,$desc,$img){
		$dataPublikimit=date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("INSERT INTO ads2 (Titulli_ads,Permbajtja,DataPublikimit,Imazh_ads) 
		VALUES('$title', '$desc','$dataPublikimit','$img')");
        
		$stmt->execute();     
    }
	
	// Update
    public function update($title,$desc,$img,$aid){
        if($img == null)
				  $imazh=" ";
			  else
				  $imazh=", Imazh_ads='$img'";
        $stmt = $this->conn->prepare("UPDATE ads2 SET Titulli_ads='$title',Permbajtja='$desc' ".$imazh."
        WHERE Id_ads='$aid'");
		
		$stmt->execute();
 
    }



    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM ads2 WHERE Id_ads = :id");
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
