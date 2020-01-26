<?php
	session_start();
	require_once 'classes/user.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
	<!--
	<link href="user/bootstrap.css" rel="stylesheet" />-->
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
			<a href="home.php" id="logo"><img src="images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="home.php">Home</a>
				</li>
				<li>
					<a href="filmat.php">Movies</a>
				</li>
				<li>
					<a onclick="window.alert('Please login first !');">Book Ticket</a>
				</li>
				<li>
					<a href="regjistrimi.php">Register</a>
				</li>
				<li class="selected">
					<a href="logimi.php">Login</a>
				</li>
				<li>
					<a href="rrethnesh.php">Contact Us</a>
				</li>
			</ul>
		</div>
	</div>

	<div id="body" class="loginreg">
<!--
		<h2 style="text-align:center;color:white;">Login to your account</h2>
			<hr style="border:1px solid #4F4F4F;"/><br/>-->
<br>
                   <div class="panelRegjistrim" style="width:350px;height:340px;">
                        <div style="padding: 10px;font-size:1.2em;font-weight:bold;background-color:#f5ebd4;">
                           Please enter username and password :
                        </div>
                        <div class="panelTrupi">
                           <form method="post" action="logimi.php" autocomplete="on">
                                        <br>
                                 <div class="formRresht">
                                            <input class="form-control" name="username" type="text" placeholder="Username" />
                                  </div>
                                  <div class="formRresht">
                                            <input class="form-control" name="password" type="password" placeholder="Password" />
                                  </div>

																		<div id="njoftim_gabimi" style="color:red;">

																		</div>
                                  <input type="submit" style="width:120px;margin-top:17px;margin-left:27px;" name="submit" value="Login"/>
								                  <input type="submit" style="width:120px;margin-top:17px;" name="register" value="Register"/>

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
				?>
				<script type="text/javascript">
					document.getElementById('njoftim_gabimi').innerHTML="Incorrect credentials ! Please try again";
				</script>
				<?php
//		 		echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
		 	}
		}

		if(isset($_POST['register']))
		{
			header( "location: regjistrimi.php");
		}
		?>
	</div>

	<?php include "includes/footer.php";?>
</body>
</html>
