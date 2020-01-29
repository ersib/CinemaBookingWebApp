<?php

require_once 'database.php';
require_once 'rezervim.php';

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
        return null;
      }
    }
    public function getUserByName($emri){
      $res=$this->conn->query("select * from users2 where Em_klient='$emri'");
    ;
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
        return null;
      }
    }


    // Insert
    public function insert($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti){

        $res = $this->conn->query("INSERT INTO users2 (Em_klient,username,password,Nr_tel,Email,Ditelindja,Adresa,Qyteti)
		           VALUES('$name', '$username', '$password', '$tel', '$email', '$ditelindja', '$adresa', '$qyteti')");

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

       return $res;
    }

    // Delete
    public function delete($id){
        $res = $this->conn->query("DELETE FROM users2 WHERE Id_klient = '$id'");
         return $res;
    }

    // Redirect URL method
     public function redirect($url)
	  {
	  echo "<script type='text/javascript'> document.location = '$url'; </script>";
    }

    //Kontrollon nese je admin
    public function authenticateAdmin($username,$password){

      $res=$this->conn->query("select * from admin WHERE admin='$username' AND adminpass='$password'");

      if($res->num_rows==1){
      return true;
      }
      else {
      return false;
      }
    }
    //Kontrollon nese je perdorues
    public function authenticateUser($username,$password){
      $res=$this->conn->query("select * from users2 WHERE username='$username' AND password='$password'");
      if($row=$res->fetch_array())
      {
      $userId=$row['Id_klient'];
      return $userId;
      }
      else{
      return false;
      }
    }
    // kthen rezervimet e perdoruesit
    public function getUserBookings(){
         $rezervim=new Rezervim();
         return $rezervim->getRezervimeByUserId($this->userId);
    }

    public function setNewPassword($npassword){
      $res=$this->conn->query("UPDATE users2 SET password='$npassword' WHERE Id_klient='$this->userId'");

      return $res;
    }
    public function getUserByUsername($username){
      $res=$this->conn->query("SELECT * FROM users2 WHERE username='$username'");

      if($res->fetch_array())
      return true;
      else {
        return false;
      }

    }

    public function getAllUsers(){
      $sql="SELECT * FROM users2";
      $res = $this->conn->query($sql);
    
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
   // Kontrollon nqs username i ri qe zgjedh nje perdorues eshte perdorur apo jo nga te tjeret
    public function uniqueUsername($username){
      $sql="select * from users2 where username='$username' and Id_klient!='$this->userId'";
      $res = $this->conn->query($sql);

      //$row=$res->fetch_array();
      if($res->num_rows()>0)
      return false;
      else
      return true;
    }

}
?>
