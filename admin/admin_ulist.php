
<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/user.php';
	$user=new User();
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $user->delete($fshiId);
	     echo '<script>window.alert("U fshi klienti");</script>';
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
	
</head>
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
                          User Table
                        </div>
						
						<br>
						
						<a href="admin_adduser.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add User</a>
                       <div style="left:630px;position:relative;"> 
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by name or id ..." /> 
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>
					   
						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php
							
							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Name</th><th>Username</th><th>Phone Nr</th><th>Email</th><th>Birthday</th><th>Adress</th><th>City</th>
</tr></thead><tbody>';
$msg2="";
                                  if(isset($_POST['search'])) 
								  {
								       
									  $input=$_POST['input'];
									 $sql2="SELECT * from users2 WHERE Em_klient='$input' OR Id_klient='$input'";
	                                 $result=mysqli_query($con,$sql2); 
									    if(!$result)
									 echo '<script>alert("ka error")</script>';
									 $row2=mysqli_fetch_array($result);
									 $Id=$row2['Id_klient'];
								 $Emri=$row2['Em_klient'];
								 $username=$row2['username'];
								 $tel=$row2['Nr_tel'];
								 $email=$row2['Email'];
								 $ditelindja=$row2['Ditelindja'];
								 $adresa=$row2['Adresa'];
								 $qyteti=$row2['Qyteti'];
								 
			$msg2='<tr style="color:blue;"><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$username.'</td><td>'.$tel.'</td><td>'.$email.'</td><td>'.$ditelindja.'</td>
          <td>'.$adresa.'</td><td>'.$qyteti.'</td>
		  
		  <td><a href="admin_ulist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="#"><button class="btn btn-primary">Bookings list</button></td>
		  <td><a href="admin_adduser.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		 <td><a href="bookinglist.php?userID='.$Id.'"><button class="btn btn-primary" style="background-color:#f0ad4e;border:none;">Bookings list</button></td>
		  </tr>';
								  if($Emri=="")
								  $msg2="";
								  
								  }
                                  $msg.=$msg2;
                                 $sql=$user->runQuery("select * from users2");
	                             $sql->execute();
								 if($sql->rowCount() > 0){
								 while($row=$sql->fetch(PDO::FETCH_ASSOC))
								 {
								 $Id=$row['Id_klient'];
								 $Emri=$row['Em_klient'];
								 $username=$row['username'];
								 $tel=$row['Nr_tel'];
								 $email=$row['Email'];
								 $ditelindja=$row['Ditelindja'];
								 $adresa=$row['Adresa'];
								 $qyteti=$row['Qyteti'];
								 
			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$username.'</td><td>'.$tel.'</td><td>'.$email.'</td><td>'.$ditelindja.'</td>
          <td>'.$adresa.'</td><td>'. $qyteti.'</td><td><a href="admin_ulist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_adduser.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  <td><a href="bookinglist.php?userID='.$Id.'"><button class="btn btn-primary" style="background-color:#f0ad4e;">Bookings list</button></td>
		  </tr>';
								
								 
								 }
								}
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

