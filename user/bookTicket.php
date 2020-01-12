
<?php
	session_start();
	require_once('../dbconfig/config.php');
	require '../classes/movie.php';
	require '../classes/cinema.php';
	require '../classes/shfaqje.php';
	//echo '<script>alert("'.$_SESSION['iduser'].'")</script>';

	 if(isset($_GET['filmId']))
	{
     $id = $_GET['filmId'];
	   $_SESSION['filmId']=$id;
     $film=new Movie();
		 $film->getMovieById($id);
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
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="ustyle.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="Uindex.php">Home</a>
				</li>
				<li>
					<a href="Umovies.php">Movies</a>

				</li>
				<li class="selected">
					<a href="Ubookticket.php">Book Ticket</a>
				</li>
				<li>
					<a href="Uboard.php">User Board</a>
				</li>

				<li>
					<a href="Ucontactus.php">Contact Us</a>
				</li>
			</ul>
			<a class="logout" href="../index.php">Log out</a>
		</div>
	</div>

	<div id="body" class="Adminboard">
      <div class="booking-movie">
			<div class="book-title"><?php echo $mname;?></div>
			<div class="book-image">
			 <?php
			 $msg= '<img width="300px" height="370px"
			 src="data:image/jpeg;base64,'.base64_encode($mimage).' alt="poster filmi"></img>';
			 echo $msg;
			 ?>
			</div>

			<form action="" method="post"><br>
			 <div class="book-cinema" style="position:relative;left:12%;" id="div1">

              <?php
							    $msg_kinema='								<label>Select the cinema :</label>';
                    for($i=0;$i<count($kinemate_vlefshme);$i++){
											 $msg_kinema.='<input type="radio" name="cinema" value="'.$kinemate_vlefshme[$i]['Id_kinema'].'"> '.$kinemate_vlefshme[$i]['Em_kinema'].'';
										}
										echo $msg_kinema;
								?>
        </div>


				<br><div class="book-cinema" style="position:relative;left:12%;">

				<?php
				if(isset($_POST['submit']))
				{
					?>
					      <script type="text/javascript">
								   var divK=document.getElementById("div1");
								   divK.innerHTML='  ';
							  </script>

				<?php
					if(isset($_POST['cinema']))
					{
					   $cid=$_POST['cinema'];
						 $salla_vlefshme=$film->availableTheaters($cid);
						 $msg='<label>Select the theater:</label>
	 				   <select name="salla">';

								for($i=0;$i<count($salla_vlefshme);$i++){
									$msg.='<option value="'.$salla_vlefshme[$i]['Id_salla'].'">'.$salla_vlefshme[$i]['Em_salla'].' me teknologji '.$salla_vlefshme[$i]['Teknologjia'].' </option>';

								}
								$msg.='</select>';
             echo $msg;
					}

					if(isset($_POST['salla'])){
					 $s_id=$_POST['salla'];
					 $_SESSION['idSalla']=$s_id;

					 $data_vlefshme=$film->availableDates($s_id);
					 $div2=' <label>Select the date</label> <select name="data">';
				   	  for($j=0;$j<count($data_vlefshme);$j++){
						     $div2.="<option>".$data_vlefshme[$j][0]."</option>";
					     }
					      $div2.="</select>";
					      echo $div2;
				   }

					if(isset($_POST['data']))
					{
					  $Data=$_POST['data'];
					  $_SESSION['data']=$Data;
					  $idSalla=$_SESSION["idSalla"];
						$oraret_vlefshme=$film->availableTimes($idSalla,$Data);
						$div2=' <label>Select the time </label> <select name="ora">';

						for($j=0;$j<count($oraret_vlefshme);$j++){
							 $div2.="<option>".$oraret_vlefshme[$j][0]."</option>";
						 }
						$div2.="</select>";
						echo $div2;
					}

					if(isset($_POST['ora']))
					{
					 $Ora=$_POST['ora'];

					  $Data=$_SESSION['data'];
					  $idSalla=$_SESSION["idSalla"];
						$shfaqja_kerkuar=new Shfaqje();
            $shfaqja_kerkuar=$shfaqja_kerkuar->getShow($idSalla,$Data,$Ora,$film->filmId);

						if($shfaqja_kerkuar->soldOut()){
							echo '<script>alert("Per kete shfaqje jane rezervuar te gjitha vendet !")</script>';
							header("Refresh:0");
						}
					   $_SESSION['Id_shfaqje']=$shfaqja_kerkuar->id;

					   $div4='Price :'.$shfaqja_kerkuar->cmimi.'<br><br><label>Enter the number of tickets :</label><input type="number"
						 style="width:35px;"name="biletat">';
             echo $div4;
					}

					if(isset($_POST['biletat'])){

					  $_SESSION['noT']=$_POST['biletat'];
              echo '<script>
					     window.location.href="confirmB.php?showId='.$_SESSION['Id_shfaqje'].'";
					    </script>';
					}

				}
			  ?>
			  </div><br>

            <div class="book-confirm">
							<input style="position:relative;left:30%;" class="butonadmin"  type="submit" name="submit" id="submit" value="Submit" />
              <input style="position:relative;left:30%;background-color:red;" class="butonadmin"  type="submit" name="submit"
               id="submit" value="Restart" onclick="window.location.href='booking.php?filmId=<?php echo $_SESSION['filmId']?>'" />
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
