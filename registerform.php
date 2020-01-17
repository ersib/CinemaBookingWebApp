<?php
	session_start();
	require_once 'classes/user.php';
?>


<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link href="user/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="css2/style2.css" type="text/css">
	<script type="text/javascript">
		function checkpassword(){
			var pass=document.getElementById('pass').value;
		   var cpass=document.getElementById('cpass').value;
			 var div=document.getElementById('cpwd');
			 if(pass!=cpass){
			 div.innerHTML='(The passwords dont match ! )';
			 }
			 else{
				 div.innerHTML='';
			 }
		}
		function checktel(){
			var tel=document.getElementById('tel').value;
      if(tel=='')
			return;
			var pattern=/06[0-9]{8}/;
			 var div=document.getElementById('_tel');
			 if(pattern.exec(tel)){
			 div.innerHTML='';
			 }
			 else{
				 div.innerHTML='(The phone number is incorrect ! )';
			 }
		}
		function checkemail(){
			var mail=document.getElementById('email').value;
			if(mail=='')
			return;
			var pattern=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
			 var div=document.getElementById('_email');
			 if(pattern.exec(mail)){
			 div.innerHTML='';
			 }
			 else{
				 div.innerHTML='(The email is incorrect ! )';
			 }
		}
	</script>
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
					<ul>
						<li>
							<a href="#">Now Showing</a>
						</li>
						<li>
							<a href="#">Comming Soon</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="bookticket.php">Book Ticket</a>
				</li>
				<li class="selected">
					<a href="registerform.php">Register</a>
				</li>
				<li>
					<a href="loginform.php">Login</a>
				</li>
				<li>
					<a href="contactus.php">Contact Us</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="body" class="loginreg">
		<h2 style="text-align:center;color:white;">Register form</h2>
		<hr style="border:1px solid #4F4F4F;"/><br/>

			   <div class="panel panel-danger" style="width:330px;position:relative;left:34%;">
                        <div class="panel-heading">
                           Please fill the register form :
                        </div>
                        <div class="panel-body">
                            <form action="registerform.php" method="post" enctype="multipart/form-data" autocomplete="on">
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input class="form-control" name="name"  type="text" required/>
										</div>
                                        <div class="form-group">
                                            <label>Username:</label>
                                            <input class="form-control" name="username" type="text" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input class="form-control" name="password" type="password" id='pass' required/>
                                        </div>
										<div class="form-group">
                                            <label>Confirm password:</label>
                                            <input class="form-control" name="cpassword" type="password" id='cpass' onblur="checkpassword();"required/>
                                        </div>
																				<div id="cpwd" style="color:red";>

																				</div>
										<div class="form-group">
                                            <label>Phone Nr:</label>
                                            <input type="tel" id='tel' onblur="checktel();" class="form-control"  name="tel" placeholder="06########"  pattern="06[0-9]{8}" required />
										</div>
										<div id="_tel" style="color:red">	</div>
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="email" class="form-control" onblur="checkemail();" name="email" id="email" placeholder="name@domain.com" required/>
                                        </div>
																					<div id="_email" style="color:red">	</div>
										 <div class="form-group">
                                            <label>Date of birth:</label>
                                            <input class="form-control" name="ditelindja" type="date" required/>
                                        </div>
										 <div class="form-group">
                                            <label>Adress:</label>
                                            <input class="form-control" name="adresa" type="text" required/>
                                        </div>
										 <div class="form-group">
                                            <label>City:</label>
                                            <input class="form-control" name="qyteti" type="text" required/>
                                        </div>

                                  <input type="submit"  name="submit" value="Submit" class="btn btn-danger"/>
                                   <input type="reset"  value="Clear" class="btn btn-danger"/>

                                    </form>
                            </div>
                        </div>


		<?php
		   if(isset($_POST['submit']))
		   {
		     // echo '<script type="text/javascript"> alert("Submit button clicked")</script>'; // kur shtyp submit del alert qe sapo e ke shtypur butonin
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
			         /*$query="select * from users2 WHERE username='$username'";
					     $query_run=mysqli_query($con,$query);
					  if(mysqli_num_rows($query_run)>0)*/
						$user=new User();
						if($user->getUserByUsername($username))
					  {
					    echo '<script type="text/javascript"> alert("User already exsts ... Try another username")</script>';
					  }
					  else
					  {
					    /*$query="insert into users2 values('','$emri','$username','$password','$tel','$email','$ditelindja','$adresa','$qyteti')";
						$query_run=mysqli_query($con,$query);*/
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
