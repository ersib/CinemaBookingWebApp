<?php
	session_start();
	//require_once('dbconfig/config.php');
	
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
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
		<h2 style="text-align:center;color:white;"> Add advertisement </h2>
		<hr style="border:1px solid #4F4F4F;"/><br/>
		
		<div class="formReg">
		<form action="" method="post" enctype="multipart/form-data" autocomplete="on">
		  
		  <p ><label>Advertisment Title :</label>
		  <input type="text" name="titulli" /> </p>
	
		  <p><label>Advertisment Description:</label>
		  <textarea style="margin-left:15px;" name="pershkrim" rows="3" cols="25" > </textarea></p>
		   <p><label>  Advertisment image: </label>
             <input type="file" name="Nimage" id="Nimage" accept="image">
		  </p>
			      
		 <p>  <input class="submit"  type="submit" name="submit" value="Add advertisement"/> </p>
		  
		<br/>	 
		<br/>	 
		<br/>	 
		<br/>	
	
		</form>
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
     $dbhost = "localhost";
     $dbuser = "root";
     $dbpass="";
     $db = "cinemadb";
     
	 $conn = new mysqli($dbhost, $dbuser,$dbpass ,$db) or die("Connect failed: %s\n". $conn -> error);

     if(isset($_POST['submit']))
	 {   
              
			  if(!empty($_POST['titulli']) && !empty($_POST['pershkrim']))
                {  
			        
					  if(isset($_FILES['Nimage'])) 
					{
		               $Wimg = addslashes(file_get_contents($_FILES['Nimage']['tmp_name']));
	                 }
					  $Atitle =$_POST['titulli'];              
					  $Adesc=$_POST['pershkrim'];
		  
	            
				 $query=mysqli_query($conn,"select * from ads2 where Titulli_ads='".$Atitle."'");
				   $numRreshtave=mysqli_num_rows($query);
                if($numRreshtave==0)
				{
					$sql="insert into news2 values('','$Atitle','$Adesc','$Wimg')";  
                    $result=mysqli_query($conn,$sql);  
					    
						if($result)
                       {  
                        echo "<script>window.alert('ad successfully added')</script>";  
	
                      }
                      else 
                      {  
                        echo "<scrp>window.alert('ka deshtuar');</script>";  
                      }
				}
				else
                {  
                   echo "The news already exists! Please try again with another.";  
                 }  
           
		  
	         }
      		else
           {  
             echo "All fields are required!";  
           }
	 }
else
{
	echo "<scrp>window.alert('ka deshtuar');</script>";  
}	
?>