<?php
session_start();
if(!isset($_SESSION['username']))
{
	header('location: ../logimi.php');
}
require_once '../classes/film.php';
require_once '../classes/njoftim.php';
require_once '../classes/reklame.php';
$njoftim=new Njoftim();
$film=new Film();
$reklame=new Reklame();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Cinema Theatre Website</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css">
	<link rel="stylesheet" href="ustyle.css" type="text/css">
</head>

<body>
	<div id="header">
		<div>
			<a  id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li class="selected">
					<a href="Uhome.php">Home</a>
				</li>
				<li>
					<a href="Ufilmat.php">Movies</a>
				</li>
				<li>
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
	<div id="body" class="home">

		<div id="homeWall">
		<h2><a>Movies</a></h2>
		<?php
		require_once '../classes/film.php';

			$film=new Film();
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




		<div>
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
								$msg='<img src="data:image/jpeg;base64,'.base64_encode($foto).' alt ="name_of_movie" height="193px" width="240px" />';
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
							 echo $msg;?>
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
