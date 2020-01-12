<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/movie.php';
	$film=new Movie();
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $film->delete($fshiId);
	     echo '<script>window.alert("The movie is deleted !");</script>';
		 }
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
	<div id="body" class="Adminboard">

		<div class="panel panel-default" style="margin-bottom:0px;">

						<div class="panel-heading" style="font-size:1.5em;">
                          Movie Table
                        </div>

						<br>

						<a href="admin_addmovie.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add new movie</a>
                       <div style="left:630px;position:relative;">
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by name or id ..." />
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>

						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Movie title</th><th>Release Date</th><th>Duration</th><th>Genre</th><th>Cast</th><th>Description</th><th>Director</th>
<th>Poster</th><th></th>
</tr></thead><tbody>';
$msg2="";
                                  if(isset($_POST['search']))
								  {

									  $input=$_POST['input'];
									 $sql2="select * from movies2 where Titull_film='$input' or Id_film='$input'";
	                                 $result=mysqli_query($con,$sql2);
									    if(!$result)
									 echo '<script>alert("ka error")</script>';

									 $row2=mysqli_fetch_array($result);
									 $Id=$row2['Id_film'];
								 $Emri=$row2['Titull_film'];
								 $rdate=$row2['Data_fillimit'];
								 $koha=$row2['Kohezgjatja'];
								 $zhanri=$row2['Zhanri'];
								 $kasti=$row2['Kasti'];
								 $desc=$row2['Pershkrim'];
								 $regj=$row2['Regjisori'];
								 $img=$row2['Imazhi_film'];

			$msg2='<tr style="color:blue;"><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$rdate.'</td><td>'.$koha.'</td><td>'.$zhanri.'</td><td>'.$kasti.'</td>
          <td>'.$desc.'</td><td>'.$regj.'</td><td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td><td><a href="admin_mlist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_addmovie.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>';
								  if($Emri=="")
								  $msg2="";

								  }
                                  $msg.=$msg2;
                                 $sql=$film->runQuery("select * from movies2");
	                             $sql->execute();
								 if($sql->rowCount() > 0){
								 while($row=$sql->fetch(PDO::FETCH_ASSOC))
								 {
								  $Id=$row['Id_film'];
								 $Emri=$row['Titull_film'];
								 $rdate=$row['Data_fillimit'];
								 $koha=$row['Kohezgjatja'];
								 $zhanri=$row['Zhanri'];
								 $kasti=$row['Kasti'];
								 $desc=$row['Pershkrim'];
								 $regj=$row['Regjisori'];
								 $img=$row['Imazhi_film'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$rdate.'</td><td>'.$koha.'</td><td>'.$zhanri.'</td><td>'.$kasti.'</td>
          <td>'.$desc.'</td><td>'.$regj.'</td><td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img>
		  </td><td><a href="admin_mlist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_addmovie.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
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
