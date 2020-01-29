<?php
session_start();
if(!isset($_SESSION['username']))
{
	header('location: ../logimi.php');
}
	require '../classes/rezervim.php';
	require '../classes/user.php';


	$Id=$_SESSION['iduser'];

  $user=new User();
	$rezervim=new Rezervim();
  $currentUser=$user->getUserById($Id);
	$username=$currentUser->username;
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Uboard</title>
	<link href="bootstrap.css" rel="stylesheet" />
		<link rel="stylesheet" href="../css2/style2.css" type="text/css">
	<link rel="stylesheet" href="ustyle.css" type="text/css">


</head>
<body>
	<div id="header">

		<div>
			<a href="home.php" id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="Uhome.php">Home</a>
				</li>
				<li >
					<a href="Ufilmat.php">Movies</a>

				</li>
				<li>
					<a href="rezervoFilm.php">Book Ticket</a>
				</li>
				<li class="selected">
					<a href="Uboard.php">User Board</a>
				</li>

				<li>
					<a href="Urrethnesh.php">Contact Us</a>
				</li>

			</ul>

			<a class="logout" href="../logout.php">Log out</a>
		</div>
	</div>




<div id="body" class="Userboard">
   <div id="leftcolumn">
    <div class="vertical-menu">
      <a href="rezervoFilm.php">Book a ticket</a>
      <a href="rezervimetEmia.php">My bookings</a>
      <a href="llogariaIme.php">My account</a>
      <a href="ndryshoPass.php">Change password</a>
    </div>
  </div>

  <div id="rightcolumn">
  <h3>Welcome <?php echo $username?> to Userboard </h3>
<br>
			<div class="total">
				<br><br>
          <strong>Total bookings :</strong> <?php
                     echo count($user->getUserBookings());

				  ?>
			</div>
			<div class="total">
				<br><br>
					<strong>Succesfully done bookings :</strong> <?php
										 echo count($rezervim->getDone($Id));

					?>
			</div>
			<div class="total">
				<br><br>
					<strong>Expired bookings :</strong> <?php
										 echo count($rezervim->getExpired($Id));

					?>
			</div>
			<div class="total">
				<br><br>
					<strong>Paid bookings :</strong> <?php
										 echo count($rezervim->getPaid($Id));

					?>
			</div>
			<div class="total">
				<br><br>
					<strong>Cancelled bookings :</strong> <?php
										 echo count($rezervim->getCancelled($Id));

					?>
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
