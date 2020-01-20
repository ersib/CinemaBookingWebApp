<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/user.php';
	$Id=$_SESSION['iduser'];
  $current_user=new User();
	$current_user=$current_user->getUserById($Id);
	$username=$current_user->username;
	$password=$current_user->password;
  $emri=$current_user->emri;

?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Uboard</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css">
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
  <a href="Umybookings.php" >My bookings</a>
  <a href="Umyaccount.php" >My account</a>
  <a href="upassword.php" class="active">Change password</a>

</div>
  </div>


  <div id="rightcolumn" >

  <h3><strong>Change Password</strong> </h3><br>

   <div class="myaccount">
      <div class="panel panel-danger">
                        <div class="panel-heading">
                           Fill the form to change the password :
                        </div>
                        <div class="panel-body">
                            <form action="" method="post">

                                 <div class="form-group">
                                            <label>Enter Old Password</label>
                                            <input class="form-control" name="opassword" type="text" />

                                        </div>
                                            <div class="form-group">
                                            <label>Enter New Password</label>
                                            <input class="form-control" name="npassword" type="password" />

                                        </div>
                                  <input type="submit" name="save" value="Submit" class="btn btn-danger"/>


                                    </form>
                            </div>
                        </div>





   </div>
   <br>

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
		   if(isset($_POST['save']))
		   {
			     if($password==$_POST['opassword']){

							 $npassword=$_POST['npassword'];
						 if($current_user->setNewPassword($npassword))
						     echo '<script type="text/javascript"> alert("Password succesfully changed!")</script>';
						 else
						 	echo '<script type="text/javascript"> alert("Error!")</script>';
				   }
				  else
						    echo '<script type="text/javascript"> alert("Please retype your old password!")</script>';
		   }
		?>
