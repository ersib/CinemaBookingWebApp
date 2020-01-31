

<?php
session_start();
if(!isset($_SESSION['admin']))
{
	header('location: ../logimi.php');
}
	require_once '../classes/kinema.php';
	$kinema=new Kinema();
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

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website</title>
<link href="font-awesome.css" rel="stylesheet" />
<link href="bootstrap.css" rel="stylesheet" />

	<link rel="stylesheet" href="styleadmin3.css" type="text/css">

</head>
<body>
	<div id="header">
		<div class="admboard">
			<a  id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../logout.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>
	<div id="body" class="Adminboard">

		<div class="panel panel-default" style="margin-bottom:0px;">

						<div class="panel-heading" style="font-size:1.5em;">
                          Cinema Table
                        </div>

						<br>

						<a href="shto_kinema.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Cinema</a>


						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover" style="width:600px;"><thead><tr>
<th>#</th><th>Name</th><th>Adress</th><th>Phone Number</th>
</tr></thead><tbody>';
$msg2="";

								$kinemate=$kinema->getAllCinemas();
                $nr_kinemave=count($kinemate);

								 for($i=0;$i<$nr_kinemave;$i++)
								 {
								 $Id=$kinemate[$i]['Id_kinema'];
								 $cemri=$kinemate[$i]['Em_kinema'];
								 $adresa=$kinemate[$i]['Adresa'];
								 $tel=$kinemate[$i]['Telefoni'];

			$msg.='<tr><td>'.$Id.'</td><td>'.$cemri.'</td><td>'.$adresa.'</td><td>'.$tel.'</td>
        <!--  <td><a href="#">Theatres list</a></td>-->
		  <td><a href="lista_kinemave.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td style="width:80px;"><a href="shto_kinema.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td></tr>';
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
=======

<?php
	session_start();
	require_once '../classes/kinema.php';
	$kinema=new Kinema();
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

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
<link href="font-awesome.css" rel="stylesheet" />
<link href="bootstrap.css" rel="stylesheet" />

	<link rel="stylesheet" href="styleadmin3.css" type="text/css">

</head>
<body>
	<div id="header">
		<div class="admboard">
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../home.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>
	<div id="body" class="Adminboard">

		<div class="panel panel-default" style="margin-bottom:0px;">

						<div class="panel-heading" style="font-size:1.5em;">
                          Cinema Table
                        </div>

						<br>

						<a href="shto_kinema.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Cinema</a>


						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover" style="width:600px;"><thead><tr>
<th>#</th><th>Name</th><th>Adress</th><th>Phone Number</th>
</tr></thead><tbody>';
$msg2="";

								$kinemate=$kinema->getAllKinemas();
                $nr_kinemave=count($kinemate);

								 for($i=0;$i<$nr_kinemave;$i++)
								 {
								 $Id=$kinemate[$i]['Id_kinema'];
								 $cemri=$kinemate[$i]['Em_kinema'];
								 $adresa=$kinemate[$i]['Adresa'];
								 $tel=$kinemate[$i]['Telefoni'];

			$msg.='<tr><td>'.$Id.'</td><td>'.$cemri.'</td><td>'.$adresa.'</td><td>'.$tel.'</td>
        <!--  <td><a href="#">Theatres list</a></td>-->
		  <td><a href="lista_kinemave.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td style="width:80px;"><a href="shto_kinema.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td></tr>';
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
