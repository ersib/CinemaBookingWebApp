<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/movie.php';
	$film = new Movie();
	
	if(isset($_GET['editID']))
	{
         $editId=$_GET['editID'];
		 $sql="select * from movies2 where Id_film='$editId'";
	     $result=mysqli_query($con,$sql);
		 $row=mysqli_fetch_array($result);
	     $Id=$row['Id_film'];
		$Emri=$row['Titull_film'];
		$rdate=$row['Data_fillimit'];
		$koha=$row['Kohezgjatja'];
		$zhanri=$row['Zhanri'];
		$kasti=$row['Kasti'];
		$desc=$row['Pershkrim'];
		$regjizor=$row['Regjisori'];
		$trailer=$row['TrailerUrl'];
		$img=$row['Imazhi_film'];						 
		$Wimg=$row['Imazh_wall'];	
	}
	else
	{
		$Emri="";
		$rdate="";
		$koha="";
		$zhanri="";
		$kasti="";
		$desc="";
		$img="";						 
		$Wimg="";	
$regjizor="";
		$trailer="";	
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
	
	<div id="body" class="Adminboard" >
		<div class="panel panel-default" style="margin-bottom:0px;">
		
		
		         <div class="panel panel-info" style="width:100%;position:relative;font-size:1.2em;">
                         <div class="panel-heading">
						 
                           <?php if(isset($_GET['editID'])) echo 'Movie Details';
						   else echo 'Add Movie';
						   ?>
						   	<a href="admin_mlist.php"><input type="submit" style="background-color:#008000;float:right;"value="Back to Movie Table"  class="btn btn-info"/></a>
                        </div>
						
                        <div class="panel-body">
						  
                            <form action="" method="post" enctype="multipart/form-data">
							<?php 
							    if(isset($_GET['editID'])){
                                        echo '<div class="form-group">
                                            <label>Id:</label>
		                                    <input type="text" readonly name="name" size="20" value="'.$editId.'"  />
                                       </div>';
							    }
							?>	
			
										<div class="form-group">
                                            <label>Movie title :</label>
		                                    <input type="text" name="mname" value="<?php echo $Emri; ?>"/> 
                                       </div>
									 
									   <div class="form-group">
                                          <label>Release date :</label>
                                          <input class="form-control" style="width:150px;" name="rdate"  type="date"/>
										  <?php if(isset($_GET['editID']))  
											  echo '( Current : '.$rdate.' )<br>';?>
										  </div>
                                 <div class="form-group">
                                            <label>Duration :</label>
											<input type="text" value="<?php echo $koha; ?>" name="koha" size="4" required  />
		
                                        </div>
                                        <div class="form-group">
                                            <label>Genre :</label>
		                                    <input type="text" required name="zhanri" value="<?php echo $zhanri; ?>" /> 
                                        </div>
										 <div class="form-group">
                                             <label>Cast :</label><br>
											  <textarea  name="kasti" cols="20" rows="3"><?php echo $kasti; ?></textarea>
											  
                                        </div>
										
                                  <div class="form-group">
                                 <label>Description:</label><br>
		    <textarea  name="desc" cols="50" rows="5"><?php echo $desc; ?></textarea>
			
                                    </div>
									     <div class="form-group">
                                            <label>Director :</label>
		                                    <input type="text" required name="regjizori" value="<?php echo $regjizor; ?>" /> 
                                        </div>
										 <div class="form-group">
                                             <label>Trailer :</label>
											  <input required type="text" name="trailerurl"  value="<?php echo $trailer; ?>"/>
                                        </div>
										  
										<div class="form-group">
                                          <label>Movie poster :</label><br>
										  <?php if(isset($_GET['editID']))
											echo '<img style="width:100px;height:125px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img>';  
										  ?>
		                               <input type="file" name="image" accept="image"/>   
                                        </div>
										<div class="form-group">
                                          <label>Wall image:</label><br>
                                          <?php if(isset($_GET['editID']))
											echo '<img style="width:200px;height:150px;" src="data:image/jpeg;base64,'.base64_encode($Wimg).' alt="poster"></img>';  
										  ?>
		                               <input type="file" name="Wimage" accept="image"/> 
                                        </div>
								
                                       <br><input type="submit" name="submit" value="Save" class="btn btn-info"/><br><br>

									   </form>
									   

                                    
                            
							
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
<?php
      if(isset($_POST['submit']))
		   {
		    // echo '<script type="text/javascript"> alert("Submit button clicked'.$editId.'")</script>'; // kur shtyp submit del alert qe sapo e ke shtypur butonin
			          if(getimagesize($_FILES['image']['tmp_name'])) 
					 {
						echo '<script type="text/javascript"> alert("Po merret posteri ")</script>';
		               $fp = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					 }
					 else 
						 $fp=null;
					   //$res=mysqli_query($con,"UPDATE movies2 SET Imazhi_film='$fp' WHERE Id_film='$editId'");
					  if(getimagesize($_FILES['Wimage']['tmp_name'])) 
					 {
		               echo '<script type="text/javascript"> alert("U mor walli!")</script>';
					   $Wimg = addslashes(file_get_contents($_FILES['Wimage']['tmp_name']));
					  // $res=mysqli_query($con,"UPDATE movies2 SET Imazh_wall='$Wimg'");
					  }
					  else
						  $Wimg=null;
					
					  
					  $movname =$_POST['mname'];  
                      $movDate=$_POST['rdate'];  
                      $movTime =$_POST['koha']; 
                      $movGenre =$_POST['zhanri']; 
                      $movCast=$_POST['kasti']; 
                      $movDir=$_POST['regjizori']; 
					  $movDesc=$_POST['desc'];
					  $movURL=$_POST['trailerurl'];
					  
				 //$sql="select * from users2 where username='$username' and Id_klient<>'$editId'";
			     //$result=mysqli_query($con,$sql);
				// $nr=mysqli_num_rows($result);
				 //echo '<script type="text/javascript"> alert("'.$nr.'!")</script>';
				 //if($password==$cpassword)
			    //{
					//if(isset($_GET['editID']))
					//{
						
						if(isset($_GET['editID'])&& !isset($_POST['rdate'])){
							  /* if(mysqli_num_rows($result)>0)
					          {	
					               echo '<script type="text/javascript"> alert("Alreadu used username !")</script>';
					          }else{*/
							  // echo '<script type="text/javascript"> alert(" A'.$movname.','.$movTime.'</script>';
							  
						$film->update($movname,null,$movTime,$movGenre,$movCast,$movDesc,$movDir,$movURL,$fp,$Wimg,$editId);					    
						$film->redirect("admin_mlist.php");
						echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
							  //}						
						}
						else if(isset($_GET['editID'])&& isset($_POST['rdate'])){
							  /*if(mysqli_num_rows($result)>0)
					          {	
					               echo '<script type="text/javascript"> alert("Alreadu used username !")</script>';
					          }
							  else{*/
							  /*echo '<script type="text/javascript"> alert(" A'.$movname.','.$movTime.','.$movGenre.','.$movCast.','.$movDir.',
							   '.$movDesc.','.$movURL.','.$editId.'");</script>';*/
						$film->update($movname,$movDate,$movTime,$movGenre,$movCast,$movDesc,$movDir,$movURL,$fp,$Wimg,$editId);
						echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
							  $film->redirect("admin_addmovie.php?editID=".$editId."");
							  //}
						}
						else
						{
							//echo '<script type="text/javascript"> alert(" A'.$movname.','.$movTime.'")</script>';
							//if($nr==0){
							//if($password==$cpassword)
			                //{
							$film->insert($movname,$movDate,$movTime,$movGenre,$movCast,$movDesc,$movDir,$movURL,$fp,$Wimg);
							echo '<script type="text/javascript"> alert("User is added succesfully !")</script>';
							$film->redirect("admin_mlist.php");
							//}
							/*else{
								echo '<script type="text/javascript"> alert("The password doesn\'t match !")</script>';
							}*/
							//}
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
		       
?>