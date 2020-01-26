<?php
require_once 'classes/film.php';
require_once 'classes/njoftim.php';
require_once 'classes/reklame.php';
$njoftim=new Njoftim();
$film=new Film();
$reklame=new Reklame();

?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Cinema Theatre Website Template</title>
	<link rel="stylesheet" href="css2/style2.css" type="text/css">

</head>

<body>
	<div id="header">
	  <div>
	    <a href="home.php" id="logo"><img src="images/logo.png" alt=""></a>
	    <ul>
	      <li class="selected">
	        <a href="home.php">Home</a>
	      </li>
	      <li>
	        <a href="filmat.php">Movies</a>
	      </li>
	      <li>
	        <a onclick="window.alert('Please login first !');">Book Ticket</a>
	      </li>
	      <li>
	        <a href="regjistrimi.php">Register</a>
	      </li>
	      <li>
	        <a href="logimi.php">Login</a>
	      </li>
	      <li>
	        <a href="rrethnesh.php">Contact Us</a>
	      </li>

	    </ul>
	  </div>

	</div>

	<div id="body" class="home" style="background-color:#fdf7e8;color:black;">

		<div id="homeWall">
		<h2>MOVIES</h2>

		<?php
      $filmat=$film->getAllFilms();
			$nr_rreshtave=count($filmat);
			$lista_fotove=array($nr_rreshtave);


			for($i=0;$i<$nr_rreshtave;$i++){
				$lista_fotove[$i]=$filmat[$i]['Imazh_wall'];
			}
			$i=rand(0,3);
			$msg='<img src="data:image/jpeg;base64,'.base64_encode($lista_fotove[$i]).' alt ="name_of_movie" height="450px" width="800px" />';
			echo $msg;
		?>

		</div>




		<div >
			<div class="njoftimeDiv">
				<h3>RECENT NEWS</h3>
				<ul>
			<?php
			$njoftimet=$njoftim->getAllNjoftime();
				   for($i=0;$i<count($njoftimet);$i++){
			      $foto=$njoftimet[$i]['Imazh_news'];
		        $titulli=$njoftimet[$i]['Titulli_news'];
				    $desc=$njoftimet[$i]['Pershkrimi_news'];

			?>
				 <li>
				     <a><?php
			          $msg='<img src="data:image/jpeg;charset=utf-8;base64,'.base64_encode($foto).' alt ="name_of_movie" height="193px" width="240px" />';
                echo $msg;?>
		         </a>
						 <h4><?php echo $titulli; ?></h4>
						 <p><?php echo $desc; ?></p>
				</li>
		<?php
			 }
		?>


				</ul>
			</div>
			<div class="reklamaDiv">
				<h3>ADVERTISEMENTS</h3>
				<ul>
					<?php
					     $reklamat=$reklame->getAllReklame();
							 for($i=0;$i<count($reklamat);$i++){
								$foto=$reklamat[$i]['Imazh_ads'];
								$titulli=$reklamat[$i]['Titulli_ads'];
								$desc=$reklamat[$i]['Permbajtja'];
					 ?>
					<li>
						<a><?php
							 $msg='<img src="data:image/jpeg;base64,'.base64_encode($foto).' alt ="name_of_movie" height="90px" width="140px" />';
							 echo $msg;
							 ?>
						</a>
						<div>
							<h4><?php echo $titulli; ?></h4>
							<p><?php echo $desc; ?></p>
						</div>
					</li>
				<?php } ?>
				</ul>
			</div>

		</div>
	</div>

	<?php include "includes/footer.php";?>
</body>
</html>
