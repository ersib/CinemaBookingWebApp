<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/user.php';
	require_once '../classes/booking.php';
//	if(isset($_GET['editID']))
//	$Id=$_GET['editID'];
//    else
  $Id=$_SESSION['iduser'];
	$user=new User();
  $rezervim=new Booking();
	$currentUser=$user->getUserById($Id);
	$username=$currentUser->username;
/*	$sql="select * from users2 where Id_klient='$Id'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	$username=$row['username'];
*/
	if(isset($_GET['deletID']))
	{
         $fshiId=$_GET['deletID'];
				if($rezervim->delete($fshiId))
				 echo '<script>window.alert("U anullua rezervimi");</script>';
				 $user->redirect('Umybookings.php');
		     /*$sql="delete from bookings2 where Id_rezervim='$fshiId'";
	       $result=mysqli_query($con,$sql);
		 if($result)
			  echo '<script>window.alert("U anullua rezervimi");</script>';*/
	}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Uboard</title>
	<link href="bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="ustyle.css" type="text/css">


</head>
<body>
	<div id="header">

		<div>
			<a href="index.php" id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="Uindex.php">Home</a>
				</li>
				<li >
					<a href="Umovies.php">Movies</a>

				</li>
				<li>
					<a href="Ubookticket.php">Book Ticket</a>
				</li>
				<li class="selected">
					<a href="Uboard.php">User Board</a>
				</li>

				<li>
					<a href="Ucontactus.php">Contact Us</a>
				</li>

			</ul>

			<a class="logout" href="../index.php">Log out</a>
		</div>
	</div>




	<div id="body" class="Userboard">


  <div id="leftcolumn">

  <div class="vertical-menu">
  <a href="Ubookticket.php" >Book a ticket</a>
  <a href="Umybookings.php" class="active">My bookings</a>
  <a href="Umyaccount.php">My account</a>
  <a href="#">Change password</a>

</div>
  </div>

  <div id="rightcolumn" >

  <h3><strong>The table of <?php echo $username?> 's bookings</strong> </h3><br><br>

               <div class="TABELA" >
			   <div class="panel panel-default">
                        <div class="panel-heading">
                           My bookings
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<?php
							$lista_rez=$currentUser->getUserBookings();

							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Movie name</th><th>Show Date</th><th>Show Time</th><th>Cinema</th><th>Theater</th><th>Tech</th><th>Nr.Seats</th>
<th>Total Price</th><th>Status</th><th>Reservation Date</th><th></th></tr></thead><tbody>';

							for($i=0;$i<count($lista_rez);$i++){
								$msg.='<tr><td>'.$lista_rez[$i]['Id_rezervim'].'</td><td style="width:20px">'.$lista_rez[$i]['Titull_film'].'</td>
								<td>'.$lista_rez[$i]['Data_sh'].'</td><td>'.$lista_rez[$i]['Ora_sh'].'</td><td>'.$lista_rez[$i]['Em_kinema'].'</td>
								<td>'.$lista_rez[$i]['Em_salla'].'</td><td>'.$lista_rez[$i]['Teknologjia'].'</td><td>'.$lista_rez[$i]['Nr_vendeve'].'</td>
								<td>'.$lista_rez[$i]['Nr_vendeve']*$lista_rez[$i]['Cmimi'].'</td><td>'.$lista_rez[$i]['Statusi'].'</td><td>'.$lista_rez[$i]['Data_rez'].'</td>
								<td><a href="Umybookings.php?deletID='.$lista_rez[$i]['Id_rezervim'].'"><input type="submit" class="butonadmin" name="submit" value="Remove booking"
								style="background-color:red;width:105px;"/></a></td></tr>';
							}
							$msg.="</tbody></table>";
							echo $msg;

							?>

                            </div>
                        </div>
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
<?php
/*if(isset($_POST['submit'])){
	echo '<script>
	window.location.href="Umybookings.php?deletID='.$Id.'"
	</script>';
}*/

?>
