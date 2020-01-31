
<?php
session_start();
if(!isset($_SESSION['admin']))
{
	header('location: ../logimi.php');
}
	require_once '../classes/shfaqje.php';
	$shfaqje=new Shfaqje();
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		     if($fshiId != null){
		      $shfaqje->delete($fshiId);
	        echo '<script>window.alert("U fshi shfaqja");</script>';
			    $shfaqje->redirect('lista_shfaqjeve.php');
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

						<div class="panel-heading" style="font-size:1.5em;">Shows Table</div>
            <br>

						<a href="shto_shfaqje.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add Show</a>

											 <div style="left:630px;position:relative;">
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by movie title ..." />
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form>
					            </div>

						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Film</th><th>Show Date</th><th>Show Time</th><th>Salla</th><th>Kinema</th><th>Price</th><th>Booked seats</th>
<th>Status</th>
</tr></thead><tbody>';
$msg2="";
                  if(isset($_POST['search']) &&  $_POST['input']!='')
								  {

									  $input=$_POST['input'];

										$search_shfaqjet=$shfaqje->getAllShowsByFilm($input);
                   $Emri="";
									for($i=0;($i<count($search_shfaqjet)) && ($i<40) ;$i++){
									 $Id=$search_shfaqjet[$i][0];
								   $Emri=$search_shfaqjet[$i][5];
								 $datash=$search_shfaqjet[$i][1];
								 $orash=$search_shfaqjet[$i][2];
								 $cmimi=$search_shfaqjet[$i][3];
								 $vendeR=$search_shfaqjet[$i][4];
								 $kinema=$search_shfaqjet[$i][6];
								 $salla=$search_shfaqjet[$i][7];
								 $status=$search_shfaqjet[$i][8];

			$msg2.='<tr style="color:blue;"><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$datash.'</td><td>'.$orash.'</td><td>'.$salla.'</td><td>'.$kinema.'</td>
          <td>'.$cmimi.'</td><td>'.$vendeR.'</td><td>'.$status.'</td>

		  <td><a href="lista_shfaqjeve.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>

		  </tr>';
									}
								  if($Emri=="")
								  $msg2="";

								  }

									$msg.=$msg2;

								$shfaqjet=$shfaqje->getAllShows();
								$nr_shfaqjeve=count($shfaqjet);

                 for($i=0;$i<$nr_shfaqjeve;$i++)
								 {
								 $Id=$shfaqjet[$i]['Id_shfaqje'];
								 $Emri=$shfaqjet[$i]['Titull_film'];
								 $datash=$shfaqjet[$i]['Data_sh'];
								 $orash=$shfaqjet[$i]['Ora_sh'];
								 $cmimi=$shfaqjet[$i]['Cmimi'];
								 $vendeR=$shfaqjet[$i]['VendeRez'];
								 $kinema=$shfaqjet[$i]['Em_kinema'];
								 $salla=$shfaqjet[$i]['Em_salla'];
								 $status=$shfaqjet[$i]['Status'];


			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$datash.'</td><td>'.$orash.'</td><td>'.$salla.'</td><td>'.$kinema.'</td>
             <td>'.$cmimi.'</td><td>'.$vendeR.'</td>  <td>'.$status.'</td><td><a href="lista_shfaqjeve.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
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
