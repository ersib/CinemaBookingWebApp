
<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/booking.php';
	$rezervim=new Booking();
	if(isset($_GET['userID']))
	{
         $userId=$_GET['userID'];
		 if($userId != null){
		 $sql=$rezervim->runQuery("SELECT users2.Em_klient FROM users2 WHERE Id_klient='$userId'");
		 $sql->execute();
		 $row=$sql->fetch(PDO::FETCH_ASSOC);
		 $userName=$row['Em_klient'];
		 }
		 else{
			 $userName="???????";
		 }
	}
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $rezervim->delete($fshiId);
	     echo '<script>window.alert("U fshi rezervimi");</script>';
		 }
	}
	
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
<link href="font-awesome.css" rel="stylesheet" />
<link href="bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="styleadmin3.css" type="text/css">
<script>
function editBooking(bid,bseats,bstatus)
{
var div=document.getElementById("printoDiv"+bid);
var p='<form method="post"><div class="form-group"><label>Nr Seats : </label><input type="text" style="width:50px;" name="nrVendeve" value="'+bseats+'"/></div>';
p+='<input type="hidden" name="idRezervim" value="'+bid+'"/>';
p+='<div class="form-group"><label>Statusi: </label><input style="width:50px;" type="text" value="'+bstatus+'" name="status" /></div><input type="submit" name="updatebooking" value="Save" class="btn btn-info"/></form>';								   
div.innerHTML=p;	

}

</script>
</head>
<?php
if(isset($_POST['updatebooking'])){
      $nrseats=$_POST['nrVendeve'];
      $status=$_POST['status'];
	  $bid=$_POST['idRezervim'];
	  $rezervim->update($nrseats,$status,$bid);
	  $rezervim->redirect("bookinglist.php?userID=".$userId."");
}
?>
<body>
	<div id="header">
		<div class="admboard">
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../index.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>
	<div id="body" class="Adminboard">
	    	   
		<div class="panel panel-default" style="margin-bottom:0px;">
                  
						<div class="panel-heading" style="font-size:1.5em;">
                          Booking list for <?php echo $userName;?>
                        </div>
						<a href="admin_ulist.php"><input type="submit" style="float:left;margin-top:5px;margin-bottom:5px;background-color:#f5f5f5;color:black;
						border:1px solid #dddddd" value="Back to Users Table"  class="btn btn-info"/></a>
						<br>
						
					   
						<div class="panel-body">
                            <div class="table-responsive">
		                           			<?php
							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Movie name</th><th>Show Date</th><th>Show Time</th><th>Cinema</th><th>Theater</th><th>Tech</th><th>Nr.Seats</th>
<th>Total Price</th><th>Reservation Date</th><th>Status</th></tr></thead><tbody>';
							     
								 /*$sql="select * from bookings2 where JId_klient='$Id'";
                             	 $result=mysqli_query($con,$sql);
	                             while($row=mysqli_fetch_array($result))
								 {
								$Id=$row['Id_rezervim'];
								 $bSeats=$row['Nr_vendeve'];
								 $bStatus=$row['Statusi'];								 
								 $showid=$row['JId_show'];
								 
								 $sql2="select * from shows2 where Id_shfaqje='$showid'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 $idfilm=$row2['JId_film'];
								 $idsalle=$row2['JId_salla'];
								 
								 $data=$row2['Data_sh'];
								 $ora=$row2['Ora_sh'];
								 $cmimi=$row2['Cmimi'];
								 $totali=$cmimi*$bSeats;
								 $sql2="select * from movies2 where Id_film='$idfilm'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 
								 $Emfilm=$row2['Titull_film'];
								 
								 $sql2="select * from theaters2 where Id_salla='$idsalle'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 $Emsalla=$row2['Em_salla'];
								 $tech=$row2['Teknologjia'];
								 $kineid=$row2['JId_kinema'];
								 $sql2="select * from cinema2 where Id_kinema='$kineid'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 $Emkinema=$row2['Em_kinema'];
								 */
								 $sql4="SELECT bookings2.Id_rezervim,
								 bookings2.Data_rez, 
								 bookings2.Nr_vendeve , 
								 bookings2.Statusi , 
                                 shows2.Data_sh,
								 shows2.Ora_sh,
								 shows2.Cmimi,
								 movies2.Titull_film,
								 theaters2.Em_salla,
								 theaters2.Teknologjia,
								 cinema2.Em_kinema
                                 FROM bookings2
								 INNER JOIN shows2 ON bookings2.JId_show=shows2.Id_shfaqje
								 INNER JOIN theaters2 ON shows2.JId_salla=theaters2.Id_salla
								 INNER JOIN cinema2 ON theaters2.JId_kinema=cinema2.Id_kinema
								 INNER JOIN movies2 ON shows2.JId_film=movies2.Id_film
                                 WHERE  bookings2.JId_klient='$userId'";
								 $res4=mysqli_query($con,$sql4);
								 if(!$res4)
								 echo '<script>window.alert("Ka gabim sql4");</script>';
					
								 while($row4=mysqli_fetch_array($res4))
								 {
								 $bid=$row4[0] 	; 
								 $dataRez=$row4[1];
								 $bseats=$row4[2];
								 $bStatus=$row4[3];
								 $data=$row4[4];
								 $ora=$row4[5];
								 $totali=$row4[6]*$bseats;
								 $Emfilm=$row4[7];
								 $Emsalla=$row4[8];
								 $tech=$row4[9];
								 $Emkinema=$row4[10];
								// echo '<script>window.alert("'.$row4[8].'");</script>';
							 
			$msg.='<tr><td>'.$bid.'</td><td style="width:20px">'.$Emfilm.'</td><td>'.$data.'</td><td>'.$ora.'</td><td>'.$Emkinema.'</td><td>'.$Emsalla.'</td>
          <td>'.$tech.'</td><td>'.$bseats.'  </td>
		  <td>'.$totali.'</td><td>'.$dataRez.'</td><td>'.$bStatus.'</td>
		  <td><a href="bookinglist.php?userID='.$userId.'&deleteID='.$bid.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td id="printoDiv'.$bid.'">
		  <button type="button" onclick="editBooking('.$bid.','.$bseats.',\''.$bStatus.'\')" class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>
		
		  ';
								 }
								// echo '<script>window.alert("<td>'.$Id.'</td><td>'.$Emfilm.'</td><td>'.$data.'</td><td>'.$ora.'</td>");</script>';
								 
								 //}
								 
								 $msg.="</tbody></table>";
								 echo $msg;
							?>
						    </div>
						</div>
         </div>

    </div>

	<div id="footer">
		<div>
			<p>
				&#169; 2023 Cinema Theatre
			</p>
			<div class="connect">
				<span>Stay Connected:</span> <a href="http://freewebsitetemplates.com/go/facebook/" id="facebook">facebook</a> <a href="http://freewebsitetemplates.com/go/twitter/" id="twitter">twitter</a> <a href="http://freewebsitetemplates.com/go/googleplus/" id="googleplus">google+</a>
			</div>
		</div>
	</div>
</body>
</html>
