<?php
	session_start();
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
					<a class="bt" href="admin_board.php"><- Back to Admin Board</a>
		</div>
	</div>
	
	<div id="body" class="Adminboard">
		
		<h2 style="text-align:center;color:white;"> Add theatre for cinema </h2>
		<hr style="border:1px solid #4F4F4F;"/><br/>
		
		
		
		<?php
     /*$dbhost = "localhost";
     $dbuser = "root";
     $dbpass="";
     $db = "cinemadb";
     
	 $conn = new mysqli($dbhost, $dbuser,$dbpass ,$db) or die("Connect failed: %s\n". $conn -> error);
      
	  $msg='<table class="tabelaC" border="1px" style="color:white;"><thead><th>ID</th><th>Name</th><th>Adress</th><th>Phone number</th></thead><tbody>';
        
        
            $sql="select * from cinema2";         
           
		   if(mysqli_query($conn,$sql))
          {
            $res=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($res))
            {       
		            
                     $cID=$row['Id_kinema'];
                    $cName=$row['Em_kinema'];
                    $cAdresa=$row['Adresa'];
                    $cTel=$row['Telefoni'];
            //       echo $cName;
					//$msg.= '<p>'.$row['Id_kinema'].$row['Em_kinema'].$row['Adresa'].$row['Telefoni'].'</p>';
                  $msg.= '<tr><td>'.$row['Id_kinema'].'</td><td>'.$row['Em_kinema'].'</td><td>'.$row['Adresa'].'</td><td>'.$row['Telefoni'].'</td></tr>';
                  
			}
			$msg.='<tbody><table>';
		}
        else{
            echo '<script type="text/javascript"> alert("Error !")</script>';
		}
	 
echo $msg;*/	 

?>  
         
		<form action="" method="get"  autocomplete="on">
		  
		  <p ><label>Choose the cinema you want to edit :   </label>
		  
		  
		  <select name="Em_kino">
		  
         
			<?php
			$dbhost = "localhost";
     $dbuser = "root";
     $dbpass="";
     $db = "cinemadb";
     
	 $conn = new mysqli($dbhost, $dbuser,$dbpass ,$db) or die("Connect failed: %s\n". $conn -> error);
	  $sql="select * from cinema2"; 
	  $kinema=array(2);
	  $i=0;
	  $msg="";
	     if(mysqli_query($conn,$sql))
        {
            $res=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($res))
            {       
		            
                     $kinema=$row['Em_kinema'];
                    $msg.='<option>'.$row['Em_kinema'].'</option>';
                  
			}	 
           // $gjatesia=$i;

      }
        else{
            echo '<script type="text/javascript"> alert("Error !")</script>';
		}
			
		
			echo $msg;
			?>
          </select>	

<br><br>      
		 <input class="butonadmin"  type="submit" name="submit" id="submit" value="Edit cinema" /> </p>
		 
	
		</form>
		<?php
		if(isset($_GET["Em_kino"]))
          {
            $dataEmer = $_GET["Em_kino"];
			$sql2="select * from cinema2 WHERE Em_kinema='$dataEmer'";
			$res=mysqli_query($conn,$sql2);
			$row=mysqli_fetch_array($res);
		
			$dataID= $row['Id_kinema'];
          }
		  
		if(isset($_GET['submit']))
	   {
	        $Em_kinema=$_GET['Em_kino'];
			//echo '<script>window.alert("'.$Em_kinema.'dhe'.$dataID.'")</script>';
				$dbhost = "localhost";
     $dbuser = "root";
     $dbpass="";
     $db = "cinemadb";
     
	 $conn = new mysqli($dbhost, $dbuser,$dbpass ,$db) or die("Connect failed: %s\n". $conn -> error);
	      //$sql="select * from cinema2 WHERE Em_kinema='$Em_kinema'";
	       //$query_run = mysqli_query($conn,$sql);
            
			$sql2="select * from cinema2 WHERE Em_kinema='$Em_kinema'";
			$res=mysqli_query($conn,$sql2);
			$row=mysqli_fetch_array($res);
		
			$idK= $row['Id_kinema'];
		//echo "<script>window.alert('Kjo eshte id e kinemase".$idK."!!')</script>";  
			    if($res)//if($query_run)
				{
					if(mysqli_num_rows($res)>0)
					{
						
					 $msg2='<div class="formReg">
					 <p>Mund te shtoni salle per '.$Em_kinema.': </p>
		             <form action="" method="post" enctype="multipart/form-data" autocomplete="on">
		  
		             <p ><label>Theater Name :</label>
		             <input type="text" name="emrisalla" /> </p>
		             <p ><label>Kapaciteti:</label>
		             <input type="text" name="sasia"  /> </p>
		             <p ><label>Teknologjia:</label>
		             <input type="text" name="tech" size="3"  /> (min)</p>
		                 
		             <p>  <input class="submit"  type="submit" name="submit2" id="submit2" value="Add theater"/> </p><br>
					 <br><br><br><br><br>
					 </form>  ';    
	                 echo $msg2;
	                
				
				   
	   
		            }
					else
					{
						echo '<script type="text/javascript">alert("No such cinema exists. Invalid Credentials")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert($Em_kinema)</script>';
				}
			
			
		  
	   }
	 
	   	               if(isset($_POST['submit2']))
	                  {
				//		  echo "<script>window.alert('shtoSalle u aktivizua".$dataID."!!')</script>";  
						  
	                      if(!empty($_POST['emrisalla']) && !empty($_POST['sasia']) && !empty($_POST['tech']) )
		                 {
		                   $Cname =$_POST['emrisalla'];  
                           $Capacity=$_POST['sasia'];  
                           $Ctech =$_POST['tech'];
					       $sql3="insert into theaters2 values('','$Cname','$Capacity','$Ctech','$dataID')";  
                            $result=mysqli_query($conn,$sql3);  
					    
						        if($result)
                                {  
                                    echo "<script>window.alert('theater successfully added')</script>";  
                                  }
								  else
								  {
									   echo "<script>window.alert('Rezultat gabim!!')</script>"; 
								  }
		                   }
						   else{
							   echo "<script>window.alert('Shkruaj vlerat me pare')</script>"; 
						   }
					  }
	                    
		?>
		
		            
	  
		
		             
					
	
	     	
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
