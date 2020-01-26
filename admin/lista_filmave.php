<?php
	session_start();
	//
	require_once '../classes/film.php';
	$film=new Film();
	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		  if($fshiId != null){
		    $film->delete($fshiId);
	      echo '<script>window.alert("The movie is deleted !");</script>';
				$film->redirect("lista_filmave.php");
		 }
	}
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
<link href="bootstrap.css" rel="stylesheet" />
<link href="font-awesome.css" rel="stylesheet" />
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

						<div class="panel-heading" style="font-size:1.5em;">Movies Table</div>
						<br>

						<a href="shto_film.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add new movie</a>
                       <div style="left:630px;position:relative;">
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by title ..." />
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form></div>

						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Film title</th><th>Release Date</th><th>Duration</th><th>Genre</th><th>Cast</th><th>Description</th><th>Director</th>
<th>Poster</th><th></th>
</tr></thead><tbody>';
$msg2="";
                  if(isset($_POST['search']) && $_POST['input']!='')
								  {

									  $input=$_POST['input'];
										$search_film=$film->getFilmByTitle($input);
                 if($search_film!=null){
									  $msg2='<tr style="color:blue;"><td>'.$search_film->filmId.'</td><td style="width:20px">'.$search_film->titulli.'</td><td>'.$search_film->data.'</td><td>'.$search_film->koha.'</td><td>'.$search_film->zhanri.'</td><td>'.$search_film->kasti.'</td>
           <td>'.$search_film->desc.'</td><td>'.$search_film->regj.'</td><td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($search_film->imazh).' alt="poster"></img></td><td><a href="lista_filmave.php?deleteID='.$search_film->filmId.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		       <td><a href="shto_film.php?editID='.$search_film->filmId.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td></tr>';
								  if($input=="")
								  $msg2="";
                  }
			         }
                $msg.=$msg2;
								$filmat=$film->getAllFilms();
							  $nr_filmave=count($filmat);

								for($i=0;$i<$nr_filmave;$i++){
								  $Id=$filmat[$i]['Id_film'];
								  $Emri=$filmat[$i]['Titull_film'];
								  $rdate=$filmat[$i]['Data_fillimit'];
								  $koha=$filmat[$i]['Kohezgjatja'];
								  $zhanri=$filmat[$i]['Zhanri'];
								  $kasti=$filmat[$i]['Kasti'];
								  $desc=$filmat[$i]['Pershkrim'];
								 $regj=$filmat[$i]['Regjisori'];
								 $img=$filmat[$i]['Imazhi_film'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$rdate.'</td><td>'.$koha.'</td><td>'.$zhanri.'</td><td>'.$kasti.'</td>
          <td>'.$desc.'</td><td>'.$regj.'</td><td><img style="width:60px;height:75px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img>
		  </td><td><a href="lista_filmave.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="shto_film.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
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
