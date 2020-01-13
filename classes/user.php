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
      $stmt=$this->conn->prepare("select * from users2 where Id_klient='$id'");
      $stmt->execute();
      if($row=$stmt->fetch()){
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
        echo '<script type="text/javascript">alert("This user does not exist !")</script>';
        return null;
      }
    }
    public function getUserByName($emri){
      $stmt=$this->conn->prepare("select * from users2 where Em_klient='$emri'");
      $stmt->execute();
      if($row=$stmt->fetch()){
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
        echo '<script type="text/javascript">alert("This user does not exist !")</script>';
        return null;
      }
    }
    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti){

        $stmt = $this->conn->prepare("INSERT INTO users2 (Em_klient,username,password,Nr_tel,Email,Ditelindja,Adresa,Qyteti)
		           VALUES('$name', '$username', '$password', '$tel', '$email', '$ditelindja', '$adresa', '$qyteti')");
		$stmt->execute();
    return $stmt;
    }

	// Update
    public function update($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti,$id){
  echo '<script type="text/javascript">alert("u futem ne update '.$id.'")</script>';
		  if($ditelindja!=null)
        $stmt = $this->conn->prepare("UPDATE users2 SET Em_klient='$name',username='$username',password='$password',Nr_tel='$tel',
		 Email='$email',
		 Ditelindja='$ditelindja', Adresa='$adresa', Qyteti='$qyteti' WHERE Id_klient='$id'");
		 else if($ditelindja==null)
			  $stmt = $this->conn->prepare("UPDATE users2 SET Em_klient='$name',username='$username',password='$password',Nr_tel='$tel',
		 Email='$email',
		 Adresa='$adresa', Qyteti='$qyteti' WHERE Id_klient='$id'");

		$stmt->execute();
return $stmt;
    }



    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM users2 WHERE Id_klient = :id");
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

    public function authenticateAdmin($username,$password){
      	//echo '<script type="text/javascript">alert("Jemi ne autAdmin")</script>';
      $stmt=$this->conn->prepare("select * from admin WHERE admin='$username' AND adminpass='$password'");
      $stmt->execute();

      //$result=mysqli_query($conn,"select * from admin WHERE admin='$username' AND adminpass='$password'");
      if($stmt->fetchAll()){
      //  echo '<script type="text/javascript">alert("Je admin1 dhe '.$result.'")</script>';
      return true;
      }
      else {
          //    echo '<script type="text/javascript">alert("Nuk je admin dhe '.$result.'")</script>';
      return false;
      }
    }
    public function authenticateUser($username,$password){
      $stmt=$this->conn->prepare("select * from users2 WHERE username='$username' AND password='$password'");
      $result=$stmt->execute();
      if($row=$stmt->fetchAll())
      {
          echo '<script type="text/javascript">alert("Je user dhe '.$result.'")</script>';
      //=$stmt->fetchAll();
      $userId=$row[0]['Id_klient'];
      return $userId;
      }
      else{
        echo '<script type="text/javascript">alert("nuk je user")</script>';
      return false;
      }
    }

    public function getUserBookings(){
         $rezervim=new Booking();
         return $rezervim->getBookingsByUserId($this->userId);
    }

    public function setNewPassword($npassword){
      $stmt=$this->conn->prepare("UPDATE users2 SET password='$npassword' WHERE Id_klient='$this->userId'");
      $stmt->execute();
      return $stmt;
    }
    public function getUserByUsername($username){
      $stmt=$this->conn->prepare("SELECT * FROM users2 WHERE username='$username'");
      $stmt->execute();
      return $stmt;
    }

    public function getAllUsers(){
      $sql="SELECT * FROM users2";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      if(!$stmt)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$stmt->fetchAll();
      return $row;
    }

}
?>
