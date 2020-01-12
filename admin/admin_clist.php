
<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/cinema.php';
	$kinema=new Cinema();
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $kinema->delete($fshiId);
	     echo '<script>window.alert("U fshi kinemaja");</script>';
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
                          Cinema Table
                        </div>
						
						<br>
						
						<a href="admin_addc.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Cinema</a>
                       <div style="left:630px;position:relative;"> 
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by name or id ..." /> 
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>
					   
						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php
							
							$msg='<table class="table table-striped table-bordered table-hover" style="width:600px;"><thead><tr>
<th>#</th><th>Name</th><th>Adress</th><th>Phone Number</th>
</tr></thead><tbody>';
$msg2="";
                                  if(isset($_POST['search'])) 
								  {
								       
									  $input=$_POST['input'];
									 $sql2="select * from cinema2 where Em_kinema='$input' or Id_kinema='$input'";
	                                 $result=mysqli_query($con,$sql2); 
									    if(!$result)
									 echo '<script>alert("ka error")</script>';
									 $row2=mysqli_fetch_array($result);
									 $Id=$row2['Id_kinema'];
								 $cemri=$row2['Em_kinema'];
								 $adresa=$row2['Adresa'];
								 $tel=$row2['Telefoni'];
								
								 
			$msg2='<tr style="color:blue;"><td>'.$Id.'</td><td style="width:20px">'.$cemri.'</td><td>'.$adresa.'</td><td>'.$tel.'</td>
		 <!-- <td><a href="#">Theaters list</a></td>-->
		  <td><a href="admin_clist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /></a></td>
		  <td><a href="admin_addc.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i>Edit</button></td>
		 
		  </tr>';
								  if($cemri=="")
								  $msg2="";
								  
								  }
                                  $msg.=$msg2;
                                 $sql=$kinema->runQuery("select * from cinema2");
	                             $sql->execute();
								 if($sql->rowCount() > 0){
								 while($row=$sql->fetch(PDO::FETCH_ASSOC))
								 {
								 $Id=$row['Id_kinema'];
								 $cemri=$row['Em_kinema'];
								 $adresa=$row['Adresa'];
								 $tel=$row['Telefoni'];
								 
			$msg.='<tr><td>'.$Id.'</td><td>'.$cemri.'</td><td>'.$adresa.'</td><td>'.$tel.'</td>
        <!--  <td><a href="#">Theaters list</a></td>-->
		  <td><a href="admin_clist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td style="width:80px;"><a href="admin_addc.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td></tr>';
								
								 
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

