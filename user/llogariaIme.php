<?php
	session_start();
	require_once '../classes/user.php';
	$Id=$_SESSION['iduser'];
	$user=new User();
  $currentUser=$user->getUserById($Id);

	$username=$currentUser->username;
	$emri=$currentUser->emri;
	$tel=$currentUser->tel;
	$password=$currentUser->password;
	$email=$currentUser->email;
	$ditelindja=$currentUser->ditelindja;
	$adresa=$currentUser->adresa;
	$qyteti=$currentUser->qyteti;

?>
<!DOCTYPE html>

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

			<a class="logout" href="../home.php">Log out</a>
		</div>
	</div>




	<div id="body" class="Userboard">
	<div id="leftcolumn">

  <div class="vertical-menu">
  <a href="rezervoFilm.php" >Book a ticket</a>
  <a href="rezervimetEmia.php" >My bookings</a>
  <a href="llogariaIme.php" class="active">My account</a>
  <a href="ndryshoPass.php">Change password</a>

</div>
  </div>


  <div id="rightcolumn" >

  <h3><strong>My account</strong> </h3><br>

   <div class="myaccount">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p>This is your data</p>
                            <p>Edit your data if you want and then click save :</p>
                        </div>
                        <div class="panel-body">
						 <form action="" method="post">
                          <label>Name:</label>
		   <p ><input type="text" name="name" size="20" value="<?php echo $emri; ?>"/> </p>
		   <label>Username:</label>
		   <p ><input type="text" name="username" size="20" value="<?php echo $username; ?>" /> </p>
		   <label>Phone Nr:</label>
		   <p > <input type="tel"  name="tel" value="<?php echo $tel; ?>" placeholder="### ### ####" pattern="\d{3}+\d{3}+\d{4}" /> </p>
		   <label>Email:</label>
		   <p ><input type="email" name="email" value="<?php echo $email; ?>"  /> </p>
		   <label>Adress:</label>
		   <p ><input type="text" name="adresa" size="20" value="<?php echo $adresa; ?>" /> </p>
	       <label>City:</label>
		   <p >	  <input type="text" name="qyteti" size="20" value="<?php echo $qyteti; ?>" /> </p>
                        </div>
                        <div class="panel-footer">
                            <input type="submit" name="save" value="Save" class="btn btn-info"/></form>
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
		    // echo '<script type="text/javascript"> alert("'.$Id.'")</script>'; // kur shtyp submit del alert qe sapo e ke shtypur butonin
			   $username=$_POST['username'];
				 $emri=$_POST['name'];
			   $tel=$_POST['tel'];
				 $email=$_POST['email'];
				 $adresa=$_POST['adresa'];
				 $qyteti=$_POST['qyteti'];
				if($currentUser->update($emri,$username,$password,$tel,$email,null,$adresa,$qyteti,$currentUser->userId))
				{
						echo '<script type="text/javascript"> alert("Changes succesfully made!")</script>';
						header("Refresh:0");
				}
				else
				{
					 echo '<script type="text/javascript"> alert("Error!")</script>';
				}
			        /*$query="UPDATE users2
					SET Em_klient='$emri',username='$username',Nr_tel='$tel',Email='$email',Adresa='$adresa',Qyteti='$qyteti'
					WHERE Id_klient='$Id'";
					$query_run=mysqli_query($con,$query);

						 if($query_run)
						 {
						     echo '<script type="text/javascript"> alert("Changes succesfully made!")</script>';
						 }
						 else
						 {
						    echo '<script type="text/javascript"> alert("Error!")</script>';
						 }*/

		   }
		?>
