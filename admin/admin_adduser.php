<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/user.php';
	$user = new User();
	
	if(isset($_GET['editID']))
	{
         $editId=$_GET['editID'];
		 $sql="select * from users2 where Id_klient='$editId'";
	     $result=mysqli_query($con,$sql);
		 $row=mysqli_fetch_array($result);
	     $username=$row['username'];
         $password=$row['password'];
				 $emri=$row['Em_klient'];
			     $tel=$row['Nr_tel'];
				 $email=$row['Email'];
				 $ditelindja=$row['Ditelindja'];
				 $adresa=$row['Adresa'];
				 $qyteti=$row['Qyteti'];
	}
	else
	{
		$username="";
        $password="";
        $emri="";
	    $tel="";
				 $email="";
				 $ditelindja="";
				 $adresa="";
				 $qyteti="";
	}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link href="bootstrap.css" rel="stylesheet" />
<link href="font-awesome.css" rel="stylesheet" />
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
	
	<div id="body" class="Adminboard" style="background-color:white;">
		
		
		         <div class="panel panel-info" style="width:100%;position:relative;margin-bottom:0px;font-size:1.2em;float:left;">
                         <div class="panel-heading">
                           <?php if(isset($_GET['editID'])) echo 'User Details';
						   else echo 'Add User';
						   ?>
                        </div>

						<?php if(isset($_GET['editID']))
							echo '<a href="../user/Umybookings.php?editID='.$editId.'"><input type="submit" style="float:right;margin-left:15px;margin-top:5px;" value="Show bookings"  class="btn btn-info"/></a>';
							?>
														
							<a href="admin_ulist.php"><input type="submit" style="float:right;margin-top:5px;"value="Back to UserTable"  class="btn btn-info"/></a>
                        <div class="panel-body">
						  
                            <form action="" method="post">
							<?php 
							    if(isset($_GET['editID'])){
                                        echo '<div class="form-group">
                                            <label>Id:</label>
		                                    <input type="text" readonly name="name" size="20" value="'.$editId.'"  />
                                       </div>';
							    }
							?>		   
										<div class="form-group">
                                            <label>Name:</label>
		                                    <input required type="text" name="name" size="20" value="<?php echo $emri; ?>"/> 
                                       </div>
                                 <div class="form-group">
                                            <label>Username:</label>
		  <input required type="text" name="username" size="20" value="<?php echo $username; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password:</label>
		   <input  <?php if(isset($_GET['editID'])) echo 'type="text"';
			  else
				  echo 'type="password"';?> name="password" required size="20" value="<?php echo $password; ?>" /> 
                                        </div>
										 <div class="form-group">
                                             <label>Confirm password:</label>
		   <input  <?php if(isset($_GET['editID'])) echo 'type="text"';
			  else
				  echo 'type="password"';?>name="cpassword" required size="20" value="<?php echo $password; ?>" /> 
                                        </div>
										
                                  <div class="form-group">
<label>Phone Nr:</label>
		    <input type="tel"  name="tel" value="<?php echo $tel; ?>" required placeholder="### ### ####" pattern="\d{3}+\d{3}+\d{4}" /> 
                                    </div>
									<div class="form-group">
                                          <label>Date of birth:</label>
                                          <input class="form-control" style="width:150px;"name="ditelindja"  type="date"/><?php if(isset($_GET['editID']))  
											  echo '( Current : '.$ditelindja.' )<br>';?><br>
										<div class="form-group">
                                          <label>Email:</label>
		  <input type="email" name="email" value="<?php echo $email; ?>"  />     
                                        </div>
										<div class="form-group">
                                          <label>Adress:</label>
<input type="text" name="adresa" size="20" value="<?php echo $adresa; ?>" /> 
                                        </div>
										<div class="form-group">
										 <label>City:</label>
		   <input type="text" name="qyteti" size="20" value="<?php echo $qyteti; ?>" /> 
                                        </div>
                                       <input type="submit" name="submit" value="Save" class="btn btn-info"/>

									   </form>
									   

                                    
                            </div>

                        </div>
		
		
		  </div>
		  
		  	         <!--<div class="panel panel-info" style="width:71%;position:relative;margin-bottom:0px;font-size:1em;float:right;border:none;">
                         <div class="panel-heading" style="background-color:#fef9ed;font-size:1.1em;">User's bookings</div>
						
                        <div class="panel-body">
						
										<!--	   <div class="panel panel-default" >-->
                       
                       <!-- <div class="panel-body">
                            <div class="table-responsive">
							<?php/*
							if(isset($_GET['editID'])){
							$Id=$editId;
						
	$sql="select * from users2 where Id_klient='$Id'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	$username=$row['username'];
	}
	if(isset($_GET['deletID']))
	{
         $fshiId=$_GET['deletID'];
		 $sql="delete from bookings2 where Id_rezervim='$fshiId'";
	     $result=mysqli_query($con,$sql);
		 if($result)
			  echo '<script>window.alert("U anullua rezervimi");</script>';
	}
							
							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Movie name</th><th>Show Date</th><th>Show Time</th><th>Cinema</th><th>Theater</th><th>Tech</th><th>Nr.Seats</th>
<th>Total Price</th><th>Status</th><th></th></tr></thead><tbody>';
							     
								 $sql="select * from bookings2 where JId_klient='$Id'";
                             	 $result=mysqli_query($con,$sql);
	                             while($row=mysqli_fetch_array($result))
								 {
								$Id=$row['Id_rezervim'];
								 $bSeats=$row['Nr_vendeve'];
								 $bStatus=$row['Statusi'];								 
								 $showid=$row['JId_show'];
								 
								 $sql2="select * from shows2 where Id_shfaqje='$showid'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 $idfilm=$row2['JId_film'];
								 $idsalle=$row2['JId_salla'];
								 
								 $data=$row2['Data_sh'];
								 $ora=$row2['Ora_sh'];
								 $cmimi=$row2['Cmimi'];
								 $totali=$cmimi*$bSeats;
								 $sql2="select * from movies2 where Id_film='$idfilm'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 
								 $Emfilm=$row2['Titull_film'];
								 
								 $sql2="select * from theaters2 where Id_salla='$idsalle'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 $Emsalla=$row2['Em_salla'];
								 $tech=$row2['Teknologjia'];
								 $kineid=$row2['JId_kinema'];
								 $sql2="select * from cinema2 where Id_kinema='$kineid'";
                             	 $result2=mysqli_query($con,$sql2);
	                             $row2=mysqli_fetch_array($result2);
								 $Emkinema=$row2['Em_kinema'];
								 
								 
			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emfilm.'</td><td>'.$data.'</td><td>'.$ora.'</td><td>'.$Emkinema.'</td><td>'.$Emsalla.'</td>
          <td>'.$tech.'</td><td>'. $bSeats.'</td><td>'.$totali.'</td><td>'.$bStatus.'</td><td>
		  <a href="admin_ulist.php?deletID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a>
		  </td></tr>';
								// echo '<script>window.alert("<td>'.$Id.'</td><td>'.$Emfilm.'</td><td>'.$data.'</td><td>'.$ora.'</td>");</script>';
								 
								 }
								 $msg.="</tbody></table>";
								 if(isset($_GET['editID']))
								 echo $msg;*/
							?>

                            </div>
                      <!--  </div>
                   <!-- </div>-->

                                    
                         </div>
							
                       </div>-->
		
		
		 
		  
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
      if(isset($_POST['submit']))
		   {
		    // echo '<script type="text/javascript"> alert("Submit button clicked'.$editId.'")</script>'; // kur shtyp submit del alert qe sapo e ke shtypur butonin
			     $name=$_POST['name'];
				 $username=$_POST['username'];
			     $password=$_POST['password'];
			     $cpassword=$_POST['cpassword'];
				 $emri=$_POST['name'];
			     $tel=$_POST['tel'];
				 $email=$_POST['email'];
				 $ditelindja=$_POST['ditelindja'];
				 $adresa=$_POST['adresa'];
				 $qyteti=$_POST['qyteti'];
				 $sql="select * from users2 where username='$username' and Id_klient<>'$editId'";
			     $result=mysqli_query($con,$sql);
				 $nr=mysqli_num_rows($result);
				// echo '<script type="text/javascript"> alert("'.$nr.'!")</script>';
				 //if($password==$cpassword)
			    //{
					//if(isset($_GET['editID']))
					//{
						
						if(isset($_GET['editID'])&& !isset($_POST['ditelindja'])){
							   if(mysqli_num_rows($result)>0)
					          {	
					               echo '<script type="text/javascript"> alert("Alreadu used username !")</script>';
					          }else{
						$user->update($name,$username,$password,$tel,$email,null,$adresa,$qyteti,$editId);					    
						$user->redirect("admin_ulist.php");
						echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
							  }						
						}
						if(isset($_GET['editID'])&& isset($_POST['ditelindja'])){
							  if(mysqli_num_rows($result)>0)
					          {	
					               echo '<script type="text/javascript"> alert("Alreadu used username !")</script>';
					          }
							  else{
						$user->update($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti,$editId);
						echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
							  $user->redirect("admin_adduser.php?editID=".$editId."");
							  }
						}
						else
						{
							
							if($nr==0){
							if($password==$cpassword)
			                {
							$user->insert($name,$username,$password,$tel,$email,$ditelindja,$adresa,$qyteti);
							echo '<script type="text/javascript"> alert("User is added succesfully !")</script>';
							}
							else{
								echo '<script type="text/javascript"> alert("The password doesn\'t match !")</script>';
							}
							}
						}
					//}
                    /*else{					
			        $query="select * from users2 WHERE username='$username'";
					$query_run=mysqli_query($con,$query);
					  if(mysqli_num_rows($query_run)>0)
					  {
					    echo '<script type="text/javascript"> alert("User already exsts ... Try another username")</script>';
					  }
					  else
					  {
					    $query="insert into users2 values('','$emri','$username','$password','$tel','$email','$ditelindja','$adresa','$qyteti')";
						$query_run=mysqli_query($con,$query);
						 if($query_run)
						 {
						     echo '<script type="text/javascript"> alert("User registered ... Go to login page")</script>';
						 }
						 else
						 {
						    echo '<script type="text/javascript"> alert("Error!")</script>';
						 }
					  }
				    }*/
			    //}
				/* else
				{
				   echo '<script type="text/javascript"> alert("Password and confirm password doesnt match !")</script>';
				}*/
		   }
		       if(isset($_POST['goback']))
			   {
				 $user->redirect("admin_ulist.php");   
			   }
?>