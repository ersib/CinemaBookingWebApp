<?php
require_once 'classes/film.php';
?>

<!DOCTYPE html>

<html>
<head>
	  <meta charset="UTF-8">
	<title>Movies - Cinema Theatre Website Template</title>
	<link rel="stylesheet" href="css2/style2.css" type="text/css" media="all">

</head>
<body>
	<div id="header">
		<div>
			<a href="home.php" id="logo"><img src="images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="home.php">Home</a>
				</li>
				<li class="selected">
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

			?>
		</div>
	</div>
	<div id="body" class="movies">

		<h2>Movies</h2>

		<?php
    $film=new Film();
		$filmat=$film->getAllFilms();
		$nr_rreshtave=count($filmat);
		$msg="";

            for($i=0;$i<$nr_rreshtave;$i++)
            {

                    $mname=$filmat[$i]['Titull_film'];
                    $mdate=$filmat[$i]['Data_fillimit'];
                    $mtime=$filmat[$i]['Kohezgjatja'];
                    $mgenre=$filmat[$i]['Zhanri'];
                    $mcast=$filmat[$i]['Kasti'];
					          $mdesc=$filmat[$i]['Pershkrim'];
				          	$mdir=$filmat[$i]['Regjisori'];
					          $murl=$filmat[$i]['TrailerUrl'];
                    $mimage=$filmat[$i]['Imazhi_film'];

                  $msg.= '<div class="filmi"><a href="#"><img src="data:image/jpeg;base64,'.base64_encode($mimage).' alt ="name_of_movie" ></a>';
				  $msg.='<h3><em>'.$mname.'</em></h3>
					<p><em>Release Date</em> :'.$mdate.'</p><p><em> Duration :</em>'.$mtime.'</p>
				 <p><em>Director</em> :'.$mdir.'</p><p><em>Cast :</em>'.$mcast.'</p><p><em>Genre </em>:'.$mgenre.'</p><p><em>Description:</em></p>
				 <p>'.$mdesc.'</p><p><a href="'.$murl.'" target="_blank" style="color:red" >Watch the trailer</a> </p></div>';

			      }
          echo $msg;
		?>
	</div>

<?php include "includes/footer.php";?>
</body>
</html>
