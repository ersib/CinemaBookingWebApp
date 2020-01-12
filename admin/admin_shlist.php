
<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/shfaqje.php';
	$shfaqje=new Shfaqje();
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $user->delete($fshiId);
	     echo '<script>window.alert("U fshi shfaqja");</script>';
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
                          Shows Table
                        </div>
						
						<br>
						
						<a href="admin_addsh.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Show</a>
                       <div style="left:630px;position:relative;"> 
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by movie title ..." /> 
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>
					   
						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php
							
							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Movie</th><th>Show Date</th><th>Show Time</th><th>Theater</th><th>Cinema</th><th>Price</th><th>Booked seats</th>
<th>Status</th>
</tr></thead><tbody>';
$msg2="";
                                  if(isset($_POST['search'])) 
								  {
								       
									  $input=$_POST['input'];
									 $sql2="SELECT shows2.Id_shfaqje,shows2.Data_sh, shows2.Ora_sh ,shows2.Cmimi,shows2.VendeRez,
                                     movies2.Titull_film,cinema2.Em_kinema,theaters2.Em_salla
									 FROM shows2
                                     INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
                                     INNER JOIN movies2 ON movies2.Id_film=shows2.JId_film
									 INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
									 WHERE movies2.Titull_film='$input'";
	                                 $result=mysqli_query($con,$sql2); 
									    if(!$result)
									 echo '<script>alert("ka error")</script>';
								 
									while( $row2=mysqli_fetch_array($result)){
									 $Id=$row2[0];
								 $Emri=$row2[5];
								 $datash=$row2[1];
								 $orash=$row2[2];
								 $cmimi=$row2[3];
								 $vendeR=$row2[4];
								 $kinema=$row2[6];
								 $salla=$row2[7];
								 
			$msg2.='<tr style="color:blue;"><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$datash.'</td><td>'.$orash.'</td><td>'.$salla.'</td><td>'.$kinema.'</td>
          <td>'.$cmimi.'</td><td>'.$vendeR.'</td><td></td>
		  
		  <td><a href="admin_shlist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  
		  </tr>';
									}
								  if($Emri=="")
								  $msg2="";
								  
								  }
                                  $msg.=$msg2;
                                 $sql="SELECT shows2.Id_shfaqje,
								 shows2.Data_sh, 
								 shows2.Ora_sh ,
								 shows2.Cmimi,
								 shows2.VendeRez,
                                 movies2.Titull_film,
								 cinema2.Em_kinema,
								 theaters2.Em_salla									
									 FROM shows2
                                     INNER JOIN theaters2 ON theaters2.Id_salla=shows2.JId_salla
                                     INNER JOIN movies2 ON movies2.Id_film=shows2.JId_film
									 INNER JOIN cinema2 ON cinema2.Id_kinema=theaters2.JId_kinema
									 
									 ";
	                             $res=mysqli_query($con,$sql);
								 if(!$res) echo '<script>alert("Ka gabim")</script>';
								 //else
									// echo '<script>alert("eshte ne rregull")</script>';
								 if(mysqli_num_rows($res)){
								 while($row=mysqli_fetch_array($res))
								 {
								 $Id=$row[0];
								 $Emri=$row[5];
								 $datash=$row[1];
								 $orash=$row[2];
								 $cmimi=$row[3];
								 $vendeR=$row[4];
								 $kinema=$row[6];
								 $salla=$row[7];
								 
			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$datash.'</td><td>'.$orash.'</td><td>'.$salla.'</td><td>'.$kinema.'</td>
          <td>'.$cmimi.'</td><td>'.$vendeR.'</td>  <td></td><td><a href="admin_ulist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		
		  
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

