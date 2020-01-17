<?php
	session_start();
	require '../classes/booking.php';
	require '../classes/user.php';
	$Id=$_SESSION['iduser'];
  $user=new User();
	$rezervim=new Booking();
  $currentUser=$user->getUserById($Id);
	$username=$currentUser->username;
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Uboard</title>
	<link href="bootstrap.css" rel="stylesheet" />
<!--	<link href="assets/css/custom.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />-->
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
      <a href="Ubookticket.php">Book a ticket</a>
      <a href="Umybookings.php">My bookings</a>
      <a href="Umyaccount.php">My account</a>
      <a href="upassword.php">Change password</a>
    </div>
  </div>

  <div id="rightcolumn">
  <h3><strong>Welcome <?php echo $username?> to Userboard </strong></h3>
<br>
			<div class="total">
				<br><br>
          <strong>Total bookings :</strong> <?php
                     echo count($user->getUserBookings());

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
