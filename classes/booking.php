<?php
//require_once('../dbconfig/config.php');
require_once 'database.php';

class Booking {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }


    // Insert
    public function insert($dataRez,$NrVendeve,$Statusi,$IdKlient,$IdShfaqje){
        $res = $this->conn->query("INSERT INTO bookings2 (Data_rez,Nr_vendeve,Statusi,JId_klient,JId_show) VALUES('$dataRez','$NrVendeve','$Statusi','$IdKlient','$IdShfaqje')");
        $this->updateSeatsOfShow($IdShfaqje,$NrVendeve);
		//$res->execute();
    return $res;
    }

	// Update
    public function update($NrVendeve,$Statusi,$bid){

        $res = $this->conn->query("UPDATE bookings2 SET Nr_vendeve='$NrVendeve',Statusi='$Statusi' WHERE Id_rezervim='$bid'");
 		    //$res->execute();
        return $res;
    }

    // Delete
    public function delete($id){
    //  try{
        $res = $this->conn->query("DELETE FROM bookings2 WHERE Id_rezervim = '$id'");
    //    $res->bindparam(":id", $id);
    //    $res->execute();
    //    return $res;
    //  }catch(PDOException $e){
    //      echo $e->getMessage();
    //  }
    return $res;
    }

    // Redirect URL method
     public function redirect($url)
	  {
	    echo "<script type='text/javascript'> document.location = ".$url."; </script>";
    }

    public function getBookingsByUserId($userid){

      $this->updateBookings();

      $sql="SELECT bookings2.Id_rezervim,bookings2.Nr_vendeve,bookings2.Data_rez,bookings2.Statusi,cinema2.Em_kinema,theaters2.Em_salla,theaters2.Teknologjia,
       shows2.Data_sh,shows2.Ora_sh,shows2.Cmimi,movies2.Titull_film
      FROM bookings2
      INNER JOIN users2 ON users2.Id_klient=bookings2.JId_klient
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show
      INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
      WHERE users2.Id_klient='$userid'";
      $res = $this->conn->query($sql);
    //  $res->execute();
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    // kthen rezervimet qe nuk kane jane realizuar
    public function getExpired($userid){

      $this->updateBookings();
      $sql="SELECT bookings2.Id_rezervim,bookings2.Nr_vendeve,bookings2.Data_rez,bookings2.Statusi,cinema2.Em_kinema,theaters2.Em_salla,theaters2.Teknologjia,
       shows2.Data_sh,shows2.Ora_sh,shows2.Cmimi,movies2.Titull_film
      FROM bookings2
      INNER JOIN users2 ON users2.Id_klient=bookings2.JId_klient
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show
      INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
      WHERE users2.Id_klient='$userid' AND bookings2.Statusi='EXPIRED'";
      $res = $this->conn->query($sql);
    //  $res->execute();
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    public function getPaid($userid){

      $this->updateBookings();

      $sql="SELECT bookings2.Id_rezervim,bookings2.Nr_vendeve,bookings2.Data_rez,bookings2.Statusi,cinema2.Em_kinema,theaters2.Em_salla,theaters2.Teknologjia,
       shows2.Data_sh,shows2.Ora_sh,shows2.Cmimi,movies2.Titull_film
      FROM bookings2
      INNER JOIN users2 ON users2.Id_klient=bookings2.JId_klient
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show
      INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
      WHERE users2.Id_klient='$userid' AND bookings2.Statusi='PAID'";
      $res = $this->conn->query($sql);
      //$res->execute();
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }

    public function updateBookings(){
      $sql="SELECT shows2.Data_sh,shows2.Ora_sh,bookings2.Id_rezervim
      FROM bookings2
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show";
      $res = $this->conn->query($sql);
      //$res->execute();
      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_array();
      $data_sot=date("Y-m-d");$ora_sot=date("h:i:sa");
      for($i=0;$i<count($row);$i++){
        $data_sh=$row['Data_sh'];
        $ora_sh=$row['Ora_sh'];

         if($data_sot>$data_sh){
          $this->updateStatus($row['Id_rezervim']);
         }
         else if($data_sot==$data_sh && $ora_sot>=$ora_sh){
           $this->updateStatus($row['Id_rezervim']);
         }
      }
    }
    public function updateStatus($rezId){
      $expire="EXPIRED";
      $res = $this->conn->query("UPDATE bookings2 SET Statusi='$expire' WHERE Id_rezervim='$rezId'");
      //$res->execute();
      return $res;
    }

    public function updateSeatsOfShow($idshow,$seats){
      $res = $this->conn->query("SELECT shows2.VendeRez from shows2 WHERE Id_shfaqje='$idshow'");
    //  $res->execute();
      $row=$res->fetch_array();
      $old_seats=$row[VendeRez];
      $new_seats=$old_seats+$seats;
      $res = $this->conn->query("UPDATE shows2 SET VendeRez='$new_seats' WHERE Id_shfaqje='$idshow'");
          //  $res->execute();
      return $res;
    }

}
?>
