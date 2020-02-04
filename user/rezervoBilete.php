
<?php
session_start();
if(!isset($_SESSION['username']))
{
	header('location: ../logimi.php');
}

	require '../classes/film.php';
	require '../classes/kinema.php';
	require_once '../classes/shfaqje.php';
	require '../classes/salla.php';


	 if(isset($_GET['filmId']))
	{
     $filmId=$_GET['filmId'];
		 $film=new Film();
		 $film->getFilmById($filmId);
     $mname=$film->titulli;
		 $mimage=$film->imazh;

	   $kinemate_vlefshme=$film->availableCinemas();
	}
  else
	 {
     echo '<script>window.alert("Nuk u mor id e filmit")</script>';
    }

?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css">
	<link rel="stylesheet" href="ustyle.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<a  id="logo"><img src="../images/logo.png" alt=""></a>
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
			<a class="logout" href="../logout.php">Log out</a>
		</div>
	</div>

	<div id="body" class="Userboard">
      <div class="booking-movie">
			<div class="book-title"><?php echo $mname;?></div>
			<div class="book-image">
			 <?php
			 $msg= '<img width="300px" height="370px"
			 src="data:image/jpeg;base64,'.base64_encode($mimage).' alt="poster filmi"></img>';
			 echo $msg;
			 ?>
			</div>

			<form action="" method="post" id="rezervim_form"><br>
			 <div class="book-cinema" style="position:relative;left:12%;" id="div1">

              <?php
							    $msg_kinema='	<label>Select the cinema :</label>';
                    for($i=0;$i<count($kinemate_vlefshme);$i++){
											 $msg_kinema.='<input type="radio" name="cinema" id="'.$kinemate_vlefshme[$i]['Id_kinema'].'" value="'.$kinemate_vlefshme[$i]['Id_kinema'].'" > '.$kinemate_vlefshme[$i]['Em_kinema'].'';
										}
										echo $msg_kinema;
								?>
        </div>


				<br><div class="book-cinema"  style="position:relative;left:12%;">
					<?php

					if(isset($_POST['submit']))
					{
						?>
						<script type="text/javascript">
								 var divK=document.getElementById("div1");
								 divK.innerHTML='';
							</script>
						<?php


						if(isset($_POST['cinema']))
						{
							 $cid=$_POST['cinema'];
							 $salla_vlefshme=$film->availableTheatres($cid);
							 $msg='<label>Select the theater:</label><br>';
							 //<select name="salla">';

									for($i=0;$i<count($salla_vlefshme);$i++){
										//$msg.='<option value="'.$salla_vlefshme[$i]['Id_salla'].'">'.$salla_vlefshme[$i]['Em_salla'].' me teknologji '.$salla_vlefshme[$i]['Teknologjia'].' </option>';
$msg.='<input type="radio" name="salla" value="'.$salla_vlefshme[$i]['Id_salla'].'"/>'.$salla_vlefshme[$i]['Em_salla'].' me teknologji '.$salla_vlefshme[$i]['Teknologjia'].'<br> ';
									}
									$msg.='</select>';
							 echo $msg;
						}





						if(isset($_POST['salla'])){
						 $s_id=$_POST['salla'];
						 $data_vlefshme=$film->availableDates($s_id);
						// $div2=' <label>Select the date</label> <select name="data">';
						$div2=' <label>Select the date</label>';
								for($j=0;$j<count($data_vlefshme);$j++){
									 //$div2.="<option>".$data_vlefshme[$j][0]."</option>";
									 $div2.='<input type="radio" name="data" value="'.$data_vlefshme[$j][0].'"/> '.$data_vlefshme[$j][0].' ';
								 }
									//$div2.="</select>
                  $div2.="<input type='hidden' value='".$s_id."' name='idSalla'>";
									echo $div2;
						 }

						if(isset($_POST['data']))
						{
							$Data=$_POST['data'];
							$idSalla=$_POST['idSalla'];

							$oraret_vlefshme=$film->availableTimes($idSalla,$Data);
							$div2=' <label>Select the time </label> <select name="ora">';

							for($j=0;$j<count($oraret_vlefshme);$j++){
								 $div2.="<option>".$oraret_vlefshme[$j][0]."</option>";
							 }
							$div2.="</select>
							<input type='hidden' value='".$idSalla."' name='idSalla'/><input type='hidden' value='".$Data."' name='data2'/>";
							echo $div2;

						}

						if(isset($_POST['ora']))
						{
						   $Ora=$_POST['ora'];
						   $Data=$_POST['data2'];
							 $idSalla=$_POST['idSalla'];

							$shfaqja_kerkuar=new Shfaqje();
							$shfaqja_kerkuar=$shfaqja_kerkuar->getShow($idSalla,$Data,$Ora,$film->filmId);
							$salla_kerkuar=new Salla();
							$salla_kerkuar=$salla_kerkuar->getSallaById($idSalla);
							$vendet_mbetuara=$salla_kerkuar->kapaciteti-$shfaqja_kerkuar->vendet_rez;

							if($shfaqja_kerkuar->soldOut()){
								echo '<script>alert("Per kete shfaqje jane rezervuar te gjitha vendet !")</script>';
								header("Refresh:0");
							}

							 $div4='Price :'.$shfaqja_kerkuar->cmimi.'<br><br>
							 <label>Enter the number of tickets :</label>
							 <input type="number" style="width:35px;"name="biletat" required min="1" max="'.$vendet_mbetuara.'">
	 <input type="hidden" name="idshfaqje" value="'.$shfaqja_kerkuar->id.'">
							 ';
							 echo $div4;

						}

						if(isset($_POST['biletat'])){

							$_SESSION['noT']=$_POST['biletat'];
							$idshfaqje=$_POST['idshfaqje'];
								echo '<script>
								 window.location.href="konfirmoRez.php?showId='.$idshfaqje.'&filmId='.$filmId.'";
								</script>';
						}

					}
					?>


			  </div><br>

            <div class="book-confirm">
						<input style="position:relative;left:22%;" class="butonadmin"  type="submit" name="submit" id="submit" value="Submit" />
              <input style="position:relative;left:22%;background-color:red;" class="butonadmin"  type="reset" name="reset"
               id="submit" value="Restart" onclick="window.location.href='rezervoBilete.php?filmId=<?php echo $filmId; ?>'" />
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
