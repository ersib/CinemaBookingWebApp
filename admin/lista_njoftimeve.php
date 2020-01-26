
<?php
	session_start();

	require_once '../classes/njoftim.php';
	require_once '../classes/reklame.php';
	$njoftim=new Njoftim();
	$reklame=new Reklame();

	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $news->delete($fshiId);
	     echo '<script>window.alert("The news topic is deleted");</script>';
		 }
	}
	if(isset($_GET['deleteAID']))
	{
         $fshiId=$_GET['deleteAID'];
		 if($fshiId != null){
		    $news->delete($fshiId);
	      echo '<script>window.alert("The advertisement is deleted");</script>';
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

		<div class="panel panel-default" style="margin-bottom:0px;" >

						<div class="panel-heading" style="font-size:1.5em;">
                          News Table
                        </div>

						<br>

						<a href="shto_njoftim.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add News/Notification</a>


						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover" style="position:relative;width:78%;" ><thead><tr>
<th>#</th><th>Title</th><th>Description</th><th>Image</th
</tr></thead><tbody>';
$msg2="";

								$lista_njoftimeve=$njoftim->getAllNjoftime();

                 for($i=0;$i<count($lista_njoftimeve);$i++)
								 {
								 $Id=$lista_njoftimeve[$i]['Id_news'];
								 $title=$lista_njoftimeve[$i]['Titulli_news'];
								 $desc=$lista_njoftimeve[$i]['Pershkrimi_news'];
								 $img=$lista_njoftimeve[$i]['Imazh_news'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$title.'</td><td>'.$desc.'</td>
          <td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td>
		  <td><a href="lista_njoftimeve.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="shto_njoftim.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>';


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

						<a href="shto_reklame.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Advertisement</a>


						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover" style="position:relative;width:78%;" ><thead><tr>
<th>#</th><th>Title</th><th>Description</th><th>Image</th
</tr></thead><tbody>';
$msg2="";


														$lista_reklamave=$reklame->getAllReklame();
								for($i=0;$i<count($lista_reklamave);$i++)
								 {
								 $Id=$lista_reklamave[$i]['Id_ads'];
								 $title=$lista_reklamave[$i]['Titulli_ads'];
								 $desc=$lista_reklamave[$i]['Permbajtja'];
								 $img=$lista_reklamave[$i]['Imazh_ads'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$title.'</td><td>'.$desc.'</td>
          <td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img></td>
		  <td><a href="lista_njoftimeve.php?deleteAID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="shto_reklame.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  </tr>';

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
