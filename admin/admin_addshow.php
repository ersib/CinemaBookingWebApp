<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/shfaqje.php';
	$shfaqje = new Shfaqje();
	
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
                           <?php if(isset($_GET['editID'])) echo 'Show Details';
						   else echo 'Add show';
						   ?>
                        </div>
														
							<a href="admin_shlist.php"><input type="submit" style="float:right;margin-top:5px;"value="Back to Shows Table"  class="btn btn-info"/></a>
                        <div class="panel-body">
						  
                        
							<?php 
							    if(isset($_GET['editID'])){
                                        echo '<div class="form-group">
                                            <label>Id:</label>
		                                    <input type="text" readonly name="name" size="20" value="'.$editId.'"  />
                                       </div>';
							    }
							?>		  <form method="post"> 
										<div class="form-group"><br/><br/>
                                            <label>Please choose the movie you want to arrange a show:</label><br/><br/>
											<?php 
											$msg="";
											       $sql="SELECT movies2.Id_film,movies2.Titull_film,movies2.Imazhi_film FROM movies2";
												   $res=mysqli_query($con,$sql);
												   if(!$res)
													   echo '<script>alert("ka gabimm")</script>';
												   while($row=mysqli_fetch_array($res)){
								$msg.='<input  type="radio" name="mTitle"  value="'.$row['Id_film'].'"/> <span style="margin-right:25px;"><span>"'.$row['Titull_film'].'"</span>
								<img style="width:60px;height:75px;margin-bottom:15px;" src="data:image/jpeg;base64,'.base64_encode($row['Imazhi_film']).' alt="poster"></img>
								</span>
								';
												   }
												   echo $msg;
											?>
		                                  
                                       </div>
                                
                                       <input type="submit" name="submitM" value="Choose the movie" class="btn btn-info"/>
									   </form>
									   <br>
                                      <?php 
									 
									  if(isset($_POST['submitM']))
									  {
										  echo '<script>alert("U shtyp butoni M")</script>';
										$idfilm=$_POST['mTitle'];
										$_SESSION['filmID']=$idfilm;
										$sql="select movies2.Titull_film from movies2 WHERE Id_film='$idfilm'"; 			       
                                        $res=mysqli_query($con,$sql);
										$ROW=mysqli_fetch_array($res);
									  $sallaForm='<div class="form-group">Now please select the theater for the show about " '.$ROW['Titull_film'].' " movie :<br>
									  <form  method="post">';
		    $sallaForm.='<label>Choose the cinema :   </label><select name="Em_kino">';			      
				   $sql2="select * from cinema2"; 			       
                          $res2=mysqli_query($con,$sql2);
                         
						 while($row=mysqli_fetch_array($res2))
                         {        		               
                          $sallaForm.='<option>'.$row['Em_kinema'].'</option>';
                         }
						 $sallaForm.='</select><br/><br><input type="submit" name="submitC" value="Choose the cinema" class="btn btn-info"/></div></form>';
                         	echo $sallaForm;
									  		  
									  }
									   if(isset($_POST['submitC']))
									  {
										  echo '<script>alert("U shtyp butoni C")</script>';
										  $cName=$_POST['Em_kino'];
					        $gjejcID="select Id_kinema from cinema2 WHERE Em_kinema='$cName'";
							$res4=mysqli_query($con,$gjejcID);
							if(!$res4)
								echo '<script>alert("ka gabim ne C")</script>';
							$row4=mysqli_fetch_array($res4);
							$cID=$row4['Id_kinema'];
                            $msg4="Choose the theater and also fill the date and time:<br><br><form action='' method='post'>";
		                 // echo '<script>window.alert("Rezultati eshte '.$cID.'")</script>';
						 $sql9="select * from theaters2 WHERE JId_kinema='$cID'";
						  $kontrollo=mysqli_query($con,$sql9);
						  if(!$kontrollo)
						  {
							   echo '<script>window.alert("Nuk u arrit lidhja me theaters2")</script>';
						  }
						
						
							  while($row11=mysqli_fetch_array($kontrollo))
                             {    
								  $msg4.='<input type="radio" name="salla" value="'.$row11['Id_salla'].'">'.$row11['Em_salla'].' | Nr.seats:'.$row11['Kapaciteti'].' | 
								  Tech:'.$row11['Teknologjia'].'<br>';                     	               						 
			                 }
							 
							 echo $msg4;						  
									  
									  ?>
			<br><div class="form-group">
		<label>Date of show:</label>
		  <input type="date"  name="datashfaqjes"  /> </div>
		  <div class="form-group">
		  <label>Time of show:</label>
		  <select name="kohaeshfaqjes">
		  <option>15:00</option>
		  <option>17:00</option>
		  <option>19:00</option>
		  <option>20:00</option>
		  <option>21:00</option>
		  </select>
		  </div>
		   <div class="form-group">
		  <label>Price of a ticket:</label>
		  <input type="text"  name="cmimi"  />
		  </div>
		    <input class="btn btn-info"  type="submit" name="submit3" id="submit3" value="Add show" />
           </form>
		  <?php
			}
		   	if(isset($_POST['submit3']))
							{
								  
			                  if(!empty($_POST['salla']) && !empty($_POST['datashfaqjes']) && !empty($_POST['kohaeshfaqjes']) )
                             {   
						               //echo "<script>window.alert('Vlerat e marra :".$_POST['datashfaqjes'].";".$_POST['kohaeshfaqjes']."')</script>";
			         
					                 $SallaID =$_POST['salla'];  
                                     $DitaSH=$_POST['datashfaqjes'];  
                                     $KohaSH =$_POST['kohaeshfaqjes'];
									 $cmimi=$_POST['cmimi'];
                                    $filmID=$_SESSION['filmID'];
				                      $query=mysqli_query($con,"select * from shows2 where JId_salla='$SallaID' and Ora_sh='$KohaSH' and Data_sh='$DitaSH'");
				                        if(!$query)
							            {
											  echo "<script>window.alert('nuk po lidhet error');</script>";
										}
									  $numRreshtave=mysqli_num_rows($query);
                                   
								   if($numRreshtave==0)
				                  {
									  //echo "<scrp>window.alert('PO hidhen vlerat');</script>";  
					                    $sql="insert into shows2 values('','$DitaSH','$KohaSH','$cmimi',0,'$SallaID','$filmID')";  
                                          $result=mysqli_query($con,$sql);  
					    
						                 if($result)
                                         {  
                                        // echo "<script>window.alert('Theater show successfully added')</script>"; 
                                          echo "<script>
                                                    alert('Show successfully added');
                                                     window.location.href='admin_shlist.php';
                                                 </script>"		;							 
                                         }
                                        else 
                                        {  
                                         echo "<scrp>window.alert('ka deshtuar');</script>";  
                                        }
										//header("location:addshow.php ");	
				                  }
				                   else
                                  {  
                                   echo "<scrp>window.alert('Ka nje tjeter shfaqje ne kete orar ne kete salle');</script>";  
                                  }  
 	                         }
      		                   else
                              {  
                              echo "All fields are required!";  
                              }
						   }
		   
		  ?>
		
								 
									   

                                    
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
	
		   }
		       if(isset($_POST['goback']))
			   {
				 $user->redirect("admin_ulist.php");   
			   }
?>