<?php
require_once('../dbconfig/config.php');
require_once 'database.php';

class News {
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
        $stmt = $this->conn->prepare("INSERT INTO news2 (Titulli_news,Pershkrimi_news,DataPublikimit,Imazh_news) 
		VALUES('$title', '$desc','$dataPublikimit','$img')");
        
		$stmt->execute();     
    }
	
	// Update
    public function update($title,$desc,$img,$nid){
          if($img == null)
				  $imazh=" ";
			  else
				  $imazh=", Imazh_news='$img'";
        $stmt = $this->conn->prepare("UPDATE news2 SET Titulli_news='$title',Pershkrimi_news='$desc' ".$imazh."
        WHERE Id_news='$nid'");
		
		$res=$stmt->execute();
 if(!$res)
	 echo '<script type="text/javascript"> alert("Ka gabim !")</script>';
    }



    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM news2 WHERE Id_news = :id");
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
      //header("Location: ".$url."");
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
