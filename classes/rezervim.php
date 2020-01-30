<?php

require_once 'database.php';
require_once 'shfaqje.php';

class Rezervim {
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

    return $res;
    }

	// Update
    public function update($NrVendeve,$Statusi,$bid){

        $res = $this->conn->query("UPDATE bookings2 SET Nr_vendeve='$NrVendeve',Statusi='$Statusi' WHERE Id_rezervim='$bid'");
        return $res;
    }

    // Delete
    public function delete($id){
        $res = $this->conn->query("DELETE FROM bookings2 WHERE Id_rezervim = '$id'");
        $res2=$this->conn->query("SELECT * FROM bookings2 WHERE Id_rezervim='$id'");
        $row=$res2->fetch_array();
        $this->updateSeatsOfShow($row['JId_show'],-$row['Nr_vendeve']);
        $shfaqje=new Shfaqje();
        $shfaqje->updateStatusOfShows();
    return $res;
    }
    public function anullo($id){
        $res = $this->conn->query("UPDATE bookings2 SET Statusi='CANCELLED' WHERE Id_rezervim='$id'");
        $res2=$this->conn->query("SELECT * FROM bookings2 WHERE Id_rezervim='$id'");
        $row=$res2->fetch_array();
        $this->updateSeatsOfShow($row['JId_show'],-$row['Nr_vendeve']);
        $shfaqje=new Shfaqje();
        $shfaqje->updateStatusOfShows();

    }

    // Redirect URL method
     public function redirect($url)
	  {
	    echo "<script type='text/javascript'> document.location = ".$url."; </script>";
    }

    public function getRezervimeByUserId($userid){

      $this->updateRezervime();

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

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';

      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    // kthen rezervimet qe nuk kane jane realizuar
    public function getExpired($userid){

      $this->updateRezervime();
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

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    // kthen rezervimet qe jane paguar
    public function getPaid($userid){

      $this->updateRezervime();

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

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    public function getCancelled($userid){

      $this->updateRezervime();

      $sql="SELECT bookings2.Id_rezervim,bookings2.Nr_vendeve,bookings2.Data_rez,bookings2.Statusi,cinema2.Em_kinema,theaters2.Em_salla,theaters2.Teknologjia,
       shows2.Data_sh,shows2.Ora_sh,shows2.Cmimi,movies2.Titull_film
      FROM bookings2
      INNER JOIN users2 ON users2.Id_klient=bookings2.JId_klient
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show
      INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
      WHERE users2.Id_klient='$userid' AND bookings2.Statusi='CANCELLED'";
      $res = $this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    public function getDone($userid){

      $this->updateRezervime();

      $sql="SELECT bookings2.Id_rezervim,bookings2.Nr_vendeve,bookings2.Data_rez,bookings2.Statusi,cinema2.Em_kinema,theaters2.Em_salla,theaters2.Teknologjia,
       shows2.Data_sh,shows2.Ora_sh,shows2.Cmimi,movies2.Titull_film
      FROM bookings2
      INNER JOIN users2 ON users2.Id_klient=bookings2.JId_klient
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show
      INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
      INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
      INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
      WHERE users2.Id_klient='$userid' AND bookings2.Statusi='DONE'";
      $res = $this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_ASSOC);
      return $row;
    }
    // updaton statusin e rezervimet ne expired nqs ka kaluar data e shfaqjes per te cilen eshte kryer rezervimi
    public function updateRezervime(){
      $sql="SELECT shows2.Data_sh,shows2.Ora_sh,bookings2.Id_rezervim
      FROM bookings2
      INNER JOIN shows2 ON shows2.Id_shfaqje=bookings2.JId_show";
      $res = $this->conn->query($sql);

      if(!$res)
      echo '<script>alert("Ga gabim ne DB")</script>';
      $row=$res->fetch_all(MYSQLI_BOTH);
      $data_sot=date("Y-m-d");
      $ora_sot=date("h:i:sa");
      for($i=0;$i<count($row);$i++){
        $data_sh=$row[$i]['Data_sh'];
        $ora_sh=$row[$i]['Ora_sh'];

         if($data_sot>$data_sh){
          $this->updateStatus($row[$i]['Id_rezervim']);
         }
         else if($data_sot==$data_sh && $ora_sot>=$ora_sh){
           $this->updateStatus($row[$i]['Id_rezervim']);
         }
      }
    }
    // ndrushon status ne expired
    public function updateStatus($rezId){
      $expire="EXPIRED";
      $res = $this->conn->query("UPDATE bookings2 SET Statusi='$expire' WHERE Id_rezervim='$rezId'");
      return $res;
    }
    //  updaton vendet e zena per shfaqjen ne momentin kur rezervohet
    public function updateSeatsOfShow($idshow,$seats){
      $res = $this->conn->query("SELECT shows2.VendeRez from shows2 WHERE Id_shfaqje='$idshow'");
      $row=$res->fetch_array();
      $old_seats=$row[VendeRez];
      $new_seats=$old_seats+$seats;
      $res = $this->conn->query("UPDATE shows2 SET VendeRez='$new_seats' WHERE Id_shfaqje='$idshow'");
      return $res;
    }
    public function getAllBookings(){
      $this->updateRezervime();
      $sql="SELECT bookings2.Id_rezervim,
      bookings2.Data_rez,
      bookings2.Nr_vendeve ,
      bookings2.Statusi ,
      shows2.Data_sh,
      shows2.Ora_sh,
      shows2.Cmimi,
      movies2.Titull_film,
      theaters2.Em_salla,
      theaters2.Teknologjia,
      cinema2.Em_kinema,
      users2.Em_klient
                      FROM bookings2
      INNER JOIN shows2 ON bookings2.JId_show=shows2.Id_shfaqje
      INNER JOIN theaters2 ON shows2.JId_salla=theaters2.Id_salla
      INNER JOIN cinema2 ON theaters2.JId_kinema=cinema2.Id_kinema
      INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
                      INNER JOIN users2 ON bookings2.JId_klient=users2.Id_klient";
      $res = $this->conn->query($sql);
      $row=$res->fetch_all(MYSQLI_BOTH);
      return $row;

    }

}
?>
