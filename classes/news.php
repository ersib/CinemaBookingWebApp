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


    // Insert
    public function insert($title,$desc,$img){
		$dataPublikimit=date("Y-m-d H:i:s");
    $res = $this->conn->query("INSERT INTO news2 (Titulli_news,Pershkrimi_news,DataPublikimit,Imazh_news)
		VALUES('$title', '$desc','$dataPublikimit','$img')");
return $res;
	//	$res->execute();
    }

	// Update
    public function update($title,$desc,$img,$nid){
          if($img == null)
				  $imazh=" ";
			  else
				  $imazh=", Imazh_news='$img'";
        $res = $this->conn->query("UPDATE news2 SET Titulli_news='$title',Pershkrimi_news='$desc' ".$imazh."
        WHERE Id_news='$nid'");

		//$res=$res->execute();
 if(!$res)
	 echo '<script type="text/javascript"> alert("Ka gabim !")</script>';
   return $res;
    }



    // Delete
    public function delete($id){
    //  try{
        $res = $this->conn->query("DELETE FROM news2 WHERE Id_news = '$id'");
    //    $res->bindparam(":id", $id);
    //    $res->execute();
        return $res;
  //    }catch(PDOException $e){
  //        echo $e->getMessage();
    //  }
    }

    // Redirect URL method
    public function redirect($url)
	{
      //header("Location: ".$url."");
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }
}
?>
