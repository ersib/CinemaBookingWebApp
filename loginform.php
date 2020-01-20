<?php
	session_start();
	require_once 'classes/user.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link href="user/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="css2/style2.css" type="text/css">
	<style>
	::placeholder{
	     text-align:center;
	}
	</style>
</head>
<body>
	<div id="header">
		<div>
			<a href="index.php" id="logo"><img src="images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="movies.php">Movies</a>
				</li>
				<li>
					<a href="bookticket.php">Book Ticket</a>
				</li>
				<li>
					<a href="registerform.php">Register</a>
				</li>
				<li class="selected">
					<a href="loginform.php">Login</a>
				</li>
				<li>
					<a href="contactus.php">Contact Us</a>
				</li>
			</ul>
		</div>
	</div>

	<div id="body" class="loginreg">
<!--
		<h2 style="text-align:center;color:white;">Login to your account</h2>
			<hr style="border:1px solid #4F4F4F;"/><br/>-->
<br>
                   <div class="panel panel-danger" style="width:350px;height:300px;position:relative;left:30%;">
                        <div class="panel-heading">
                           Please enter username and password :
                        </div>
                        <div class="panel-body">
                           <form method="post" action="loginform.php" autocomplete="on">
                                        <br>
                                 <div class="form-group">
                                            <input class="form-control" name="username" type="text" placeholder="Username" />
                                  </div>
                                  <div class="form-group">
                                            <input class="form-control" name="password" type="password" placeholder="Password" />
                                  </div>
																	  <br>
                                  <input type="submit" style="width:120px" name="submit" value="Login" class="btn btn-danger"/>
								  <input type="submit" style="width:120px" name="register" value="Register" class="btn btn-danger"/>

                                    </form>
                            </div>
                        </div>


  	<?php
		if(isset($_POST['submit']))
		{
			 $username=$_POST['username'];
			 $password=$_POST['password'];

       $user=new User();

			if($user->authenticateAdmin($username,$password)){
				header( "location: admin/admin_board.php");
				}

			 	//echo '<script type="text/javascript">alert("Nr '.$userId.'")</script>';$userId!=0
			 if( $userId=$user->authenticateUser($username,$password)){
		 		$_SESSION['iduser']=$userId;
		 		$_SESSION['username'] = $username;
		 		$_SESSION['password'] = $password;
		 	 header( "location: user/Uboard.php");
		 	}
		 	else {
		 		echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
		 	}
		}

		if(isset($_POST['register']))
		{
			echo '				  <script>
					  window.location.href="registerform.php";
					  </script>';
		}
		?>
	</div>

	<?php include "includes/footer.php";?>
</body>
</html>
