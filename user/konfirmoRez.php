
<?php
  session_start();
  require_once '../classes/film.php';
	require_once '../classes/rezervim.php';
	require_once '../classes/salla.php';
	require_once '../classes/kinema.php';
	require_once '../classes/shfaqje.php';
	$film=new Film();
	$shfaqje=new Shfaqje();
	$salla=new Salla();
	$kinema=new Kinema();
  $rezervim=new Rezervim();

	if(isset($_GET['showId']))
 {
		$showid = $_GET['showId'];
    $fid=$_SESSION['filmId'];

    $film=$film->getFilmById($fid);
		$mname=$film->titulli;
		$mimage=$film->imazh;

		$shfaqje=$shfaqje->getShowById($showid);

		$salla=$salla->getSallaById($shfaqje->Id_salla);
		$Esalla=$salla->emri;
    $tech=$salla->tech;

		$kinema=$kinema->getKinemaById($salla->Id_kinema);
		$Ekinema=$kinema->emri;

		$NrVendeve=$_SESSION['noT'];
		$IdKlient=$_SESSION['iduser'];
	}


	   if(isset($_POST['submit']))
	   {

		   $Status="Done";
			 $dataRez=date("Y-m-d h:i:sa");

        if($rezervim->insert($dataRez,$NrVendeve,$Status,$IdKlient,$shfaqje->id)){
				 echo "<script>	alert('Booking successfully done');
                  window.location.href='rezervoFilm.php';
								 </script>"	;
			  }
			  else{
				 echo "<scrp>window.alert('ka deshtuar');</script>";
			  }
	   }

	 if(isset($_POST['cancel']))
	 {
		echo "<script> window.location.href='rezervoFilm.php'; </script>"		;
	 }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css">
	<link rel="stylesheet" href="ustyle.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="Uhome.php">Home</a>
				</li>
				<li>
					<a href="Ufilmat.php">Movies</a>

				</li>
				<li class="selected">
					<a href="rezervoFilm.php">Book Ticket</a>
				</li>
				<li>
					<a href="Uboard.php">User Board</a>
				</li>

				<li>
					<a href="Urrethnesh.php">Contact Us</a>
				</li>
			</ul>
			<a class="logout" href="../home.php">Log out</a>
		</div>
	</div>

	<div id="body" class="Userboard">

		<div class="booking-movie">
			<div class="book-title"><?php echo $mname;?></div>
			<div class="book-image">
			 <?php
			 $msg2= '<img width="300px" height="370px"
			 src="data:image/jpeg;base64,'.base64_encode($mimage).' alt="poster filmi"></img>';
			 echo $msg2;
			 ?>
			</div>
			<div class="ticket">

				 <div class="book-C" style="position:relative;left:8%;font-size:1.1em;"> <br>Please confirm the ticket details:</div><br>
			   <div class="book-cinema" > Kinema:<p><?php echo $Ekinema; ?></p></div>
			   <div class="book-cinema" > Salla:<p><?php echo $Esalla ?></p></div>
			   <div class="book-cinema" > Technology:<p>			 <?php echo $tech ?></p>			 </div>
			   <div class="book-cinema"> Date:<p>			 <?php echo $shfaqje->data ?></p>			 </div>
			   <div class="book-cinema"> Show Time:<p>			 <?php echo $shfaqje->ora ?></p>			 </div>
			   <div class="book-cinema"> Nr of tickets:<p>			 <?php echo $_SESSION['noT'] ?></p>			 </div>
			   <div class="book-cinema"> Total Price:<p>			 <?php echo $shfaqje->cmimi*$_SESSION['noT'] ?></p>	 </div>
			   <br>

			 </div><br>

			 <form action="" method="post">
             <div class="book-confirm">
			          <input style="position:relative;left:22%;" class="butonadmin"  type="submit" name="submit" id="submit" value="Confirm" />
			          <input style="position:relative;left:22%;background-color:red;" class="butonadmin"  type="submit" name="cancel" id="submit" value="Decline" />
		        </div>
       </form>
			 <br>
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
