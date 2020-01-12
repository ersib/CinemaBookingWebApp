
<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/news.php';
	require_once '../classes/ads.php';
	$njoftim=new News();
	$reklame=new Ads();

	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $news->delete($fshiId);
	     echo '<script>window.alert("U fshi lajmi");</script>';
		 }
	}
	if(isset($_GET['deleteAID']))
	{
         $fshiId=$_GET['deleteAID'];
		 if($fshiId != null){
		 $news->delete($fshiId);
	     echo '<script>window.alert("U fshi reklama");</script>';
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

		<div class="panel panel-default" style="margin-bottom:0px;" >

						<div class="panel-heading" style="font-size:1.5em;">
                          News Table
                        </div>

						<br>

						<a href="admin_addnews.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add News/Notification</a>
                       <div style="left:66%;position:relative;">
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by title ..." />
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>

						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover" style="position:relative;width:78%;" ><thead><tr>
<th>#</th><th>Title</th><th>Description</th><th>Image</th
</tr></thead><tbody>';
$msg2="";
                  if(isset($_POST['search']))
								  {

									  $input=$_POST['input'];
									  $sql2="SELECT * from news2 WHERE Titulli_news='$input'";
	                  $result=mysqli_query($con,$sql2);
									    if(!$result)
									    echo '<script>alert("ka error")</script>';

									 $row2=mysqli_fetch_array($result);
									 $Id=$row2['Id_news'];
								 $title=$row2['Titulli_news'];
								 $desc=$row2['Pershkrimi_news'];
								 $img=$row2['Imazh_news'];


			$msg2='<tr style="color:blue;"><td>'.$Id.'</td><td>'.$title.'</td><td>'.$desc.'</td>
          <td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td>
		  <td><a href="admin_newslist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_addnews.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>';
								  if($Emri=="")
								  $msg2="";

								  }
                                  $msg.=$msg2;
                                 $sql=$njoftim->runQuery("select * from news2");
	                             $sql->execute();
								 if($sql->rowCount() > 0){
								 while($row=$sql->fetch(PDO::FETCH_ASSOC))
								 {
								 $Id=$row['Id_news'];
								 $title=$row['Titulli_news'];
								 $desc=$row['Pershkrimi_news'];
								 $img=$row['Imazh_news'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$title.'</td><td>'.$desc.'</td>
          <td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td>
		  <td><a href="admin_newslist.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_addnews.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>';


								 }
								}
								$msg.="</tbody></table>";
								 echo $msg;
								 ?>
						    </div>
						</div>
         </div>
<div class="panel panel-default" style="margin-bottom:0px;" >

						<div class="panel-heading" style="font-size:1.5em;">
                          Advertisements Table
                        </div>

						<br>

						<a href="admin_addads.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Advertisement</a>
                       <div style="left:66%;position:relative;">
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by title ..." />
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>

						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover" style="position:relative;width:78%;" ><thead><tr>
<th>#</th><th>Title</th><th>Description</th><th>Image</th
</tr></thead><tbody>';
$msg2="";
                    if(isset($_POST['search']))
								  {

									  $input=$_POST['input'];
									 $sql2="SELECT * from ads2 WHERE Titulli_ads='$input'";
	                 $result=mysqli_query($con,$sql2);
									    if(!$result)
									 echo '<script>alert("ka error")</script>';
									 $row2=mysqli_fetch_array($result);
									 $Id=$row2['Id_ads'];
								 $title=$row2['Titulli_ads'];
								 $desc=$row2['Permbajtja'];
								 $img=$row2['Imazh_ads'];


			$msg2='<tr style="color:blue;"><td>'.$Id.'</td><td>'.$title.'</td><td>'.$desc.'</td>
          <td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td>
		  <td><a href="admin_newslist.php?deleteAID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_addads.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>';
								  if($Emri=="")
								  $msg2="";

								  }
                                  $msg.=$msg2;
                                 $sql=$reklame->runQuery("select * from ads2");
	                             $sql->execute();
								 if($sql->rowCount() > 0){
								 while($row=$sql->fetch(PDO::FETCH_ASSOC))
								 {
								 $Id=$row['Id_ads'];
								 $title=$row['Titulli_ads'];
								 $desc=$row['Permbajtja'];
								 $img=$row['Imazh_ads'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$title.'</td><td>'.$desc.'</td>
          <td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td>
		  <td><a href="admin_newslist.php?deleteAID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="admin_addads.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
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
