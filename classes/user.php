<?php

require_once 'database.php';
require_once 'booking.php';

class User {
    private $conn;
    public $userId;
    public $username;
    public $password;
    public $emri;
    public $tel;
    public $email;
    public $ditelindja;
    public $adresa;
    public $qyteti;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }

    public function getUserById($id){
      $res=$this->conn->query("select * from users2 where Id_klient='$id'");
    //  $res->execute();
      if($row=$res->fetch_array()){
        $this->username=$row['username'];
        $this->password=$row['password'];
        $this->userId=$id;
        $this->emri=$row['Em_klient'];
        $this->tel=$row['Nr_tel'];
        $this->email=$row['Email'];
        $this->ditelindja=$row['Ditelindja'];
        $this->adresa=$row['Adresa'];
        $this->qyteti=$row['Qyteti'];
       return $this;
      }
      else {
        //echo '<script type="text/javascript">alert("This user does not exist !")</script>';
        return null;
      }
    }
    public function getUserByName($emri){
      $res=$this->conn->query("select * from users2 where Em_klient='$emri'");
    //  $res->execute();
      if($row=$res->fetch_array()){
        $this->username=$row['username'];
        $this->password=$row['password'];
        $this->userId=$row['Id_klient'];;
        $this->emri=$row['Em_klient'];
        $this->tel=$row['Nr_tel'];
        $this->email=$row['Email'];
        $this->ditelindja=$row['Ditelindja'];
        $this->adresa=$row['Adresa'];
        $this->qyteti=$row['Qyteti'];
       return $this;
      }
      else {
        //echo '<script type="text/javascript">alert("This user does not exist !")</script>';
        return null;
      }
    }


    // Insert
    public function insert($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti){

        $res = $this->conn->query("INSERT INTO users2 (Em_klient,username,password,Nr_tel,Email,Ditelindja,Adresa,Qyteti)
		           VALUES('$name', '$username', '$password', '$tel', '$email', '$ditelindja', '$adresa', '$qyteti')");
		//$res->execute();
    return $res;
    }

	// Update
    public function update($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti,$id){

		  if($ditelindja!=null)
        $res = $this->conn->query("UPDATE users2 SET Em_klient='$name',username='$username',password='$password',Nr_tel='$tel',Email='$email',
		            Ditelindja='$ditelindja', Adresa='$adresa', Qyteti='$qyteti' WHERE Id_klient='$id'");
		 else if($ditelindja==null)
			  $res = $this->conn->query("UPDATE users2 SET Em_klient='$name',username='$username',password='$password',Nr_tel='$tel',Email='$email',
		       Adresa='$adresa', Qyteti='$qyteti' WHERE Id_klient='$id'");
		      //$res->execute();
       return $res;
    }

    // Delete
    public function delete($id){
    //  try{
        $res = $this->conn->query("DELETE FROM users2 WHERE Id_klient = '$id'");
      //  $res->bindparam(":id", $id);
    //    $res->execute();
    //    return $res;
  //    }catch(PDOException $e){
  //        echo $e->getMessage();
  //    }
         return $res;
    }

    // Redirect URL method
     public function redirect($url)
	  {
    //  header("Location: ".$url."");
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }

    //Kontrollon nese je admin
    public function authenticateAdmin($username,$password){
      	//echo '<script type="text/javascript">alert("Jemi ne autAdmin")</script>';
      $res=$this->conn->query("select * from admin WHERE admin='$username' AND adminpass='$password'");
      //$res->execute();
      if($res->num_rows==1){
      //  echo '<script type="text/javascript">alert("Je admin1 dhe '.$result.'")</script>';
      return true;
      }
      else {
          //    echo '<script type="text/javascript">alert("Nuk je admin dhe '.$result.'")</script>';
      return false;
      }
    }
    //Kontrollon nese je perdorues
    public function authenticateUser($username,$password){
      $res=$this->conn->query("select * from users2 WHERE username='$username' AND password='$password'");
      //$result=$res->execute();
      if($row=$res->fetch_array())
      {
        //  echo '<script type="text/javascript">alert("Je user dhe '.$result.'")</script>';
      $userId=$row['Id_klient'];
      return $userId;
      }
      else{
        //echo '<script type="text/javascript">alert("nuk je user")</script>';
      return false;
      }
    }
    // kthen rezervimet e perdoruesit
    public function getUserBookings(){
         $rezervim=new Booking();
         return $rezervim->getBookingsByUserId($this->userId);
    }

    public function setNewPassword($npassword){
      $res=$this->conn->query("UPDATE users2 SET password='$npassword' WHERE Id_klient='$this->userId'");
      //$res->execute();
      return $res;
    }
    public function getUserByUsername($username){
      $res=$this->conn->query("SELECT * FROM users2 WHERE username='$username'");
      //$res->execute();
      if($res->fetch_array())
      return true;
      else {
        return false;
      }

    }

    public function getAllUsers(){
      $sql="SELECT * FROM users2";
      $res = $this->conn->query($sql);
    //  $res->execute();
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
   // Kontrollon nqs username i ri qe zgjedh nje perdorues eshte perdorur apo jo nga te tjeret
    public function uniqueUsername($username){
      $sql="select * from users2 where username='$username' and Id_klient!='$this->userId'";
      $res = $this->conn->query($sql);
      //  $res->execute();
      //$row=$res->fetch_array();
      if($res->num_rows()>0)
      return false;
      else
      return true;
    }

}
?>
