<?php
	session_start();
	require_once 'classes/user.php';
?>


<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
	<link rel="stylesheet" href="css2/style2.css" type="text/css">
	<script type="text/javascript" src="validoRegjistrim.js">

	</script>
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
				<li class="selected">
					<a href="regjistrimi.php">Register</a>
				</li>
				<li>
					<a href="logimi.php">Login</a>
				</li>
				<li>
					<a href="rrethnesh.php">Contact Us</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="body" class="loginreg">
<br>
			   <div class="panelRegjistrim">
                        <div style="padding: 10px;font-size:1.2em;font-weight:bold;background-color:#f5ebd4;">
                           Please fill the register form :
                        </div>
                        <div class="panelTrupi">
                            <form action="regjistrimi.php" method="post" enctype="multipart/form-data" autocomplete="on">
                                        <div class="formRresht">
                                            <label>Name:</label>
                                            <input class="form-control" name="name"  type="text" required/>
										</div>
                                        <div class="formRresht">
                                            <label>Username:</label>
                                            <input class="form-control" name="username" type="text" required/>
                                        </div>
                                        <div class="formRresht">
                                            <label>Password:</label>
                                            <input class="form-control" name="password" type="password" id='pass' onblur="validoPass();" required/>
                                        </div>
																				<div id="vpwd" style="color:red";>

																				</div>
										<div class="formRresht">
                                            <label>Confirm password:</label>
                                            <input class="form-control" name="cpassword" type="password" id='cpass' onblur="checkpassword();"required/>
                                        </div>
																				<div id="cpwd" style="color:red";>

																				</div>
										<div class="formRresht">
                                            <label>Phone Nr:</label>
                                            <input type="tel" id='tel' onblur="checktel();" class="form-control"  name="tel" placeholder="06########"  pattern="06[0-9]{8}" required />
										</div>
										<div id="_tel" style="color:red">	</div>
                                        <div class="formRresht">
                                            <label>Email:</label>
                                            <input type="email" class="form-control" onblur="checkemail();" name="email" id="email" placeholder="name@domain.com" required/>
                                        </div>
																					<div id="_email" style="color:red">	</div>
										 <div class="formRresht">
                                            <label>Date of birth:</label>
                                            <input class="form-control" name="ditelindja" type="date" required/>
                                        </div>
										 <div class="formRresht">
                                            <label>Adress:</label>
                                            <input class="form-control" name="adresa" type="text" required/>
                                        </div>
										 <div class="formRresht">
                                            <label>City:</label>
                                            <input class="form-control" name="qyteti" type="text" required/>
                                        </div>

                                  <input type="submit"  name="submit" value="Submit" />
                                   <input type="reset"  value="Clear" />

                                    </form>
                            </div>
                        </div>


		<?php
		   if(isset($_POST['submit']))
		   {
			     $username=$_POST['username'];
			     $password=$_POST['password'];
			     $cpassword=$_POST['cpassword'];
				   $emri=$_POST['name'];
			     $tel=$_POST['tel'];
				   $email=$_POST['email'];
				   $ditelindja=$_POST['ditelindja'];
				   $adresa=$_POST['adresa'];
				   $qyteti=$_POST['qyteti'];

				 if($password==$cpassword)
			    {
						$user=new User();
						if($user->getUserByUsername($username)){
					    echo '<script type="text/javascript"> alert("User already exsts ... Try another username")</script>';
					  }
					  else
					  {

						 if($user->insert($emri,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti))
						 {
						     echo '<script type="text/javascript"> alert("User registered ... Go to login page")</script>';
						 }
						 else
						 {
						    echo '<script type="text/javascript"> alert("Error!")</script>';
						 }
					  }
			    }
				 else
				{
				   echo '<script type="text/javascript"> alert("Password and confirm password doesnt match !")</script>';
				}
		   }
		?>

	</div>
	<?php include "includes/footer.php";?>
</body>
</html>
