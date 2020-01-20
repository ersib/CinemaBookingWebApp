<?php
require_once 'classes/movie.php';
?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Movies - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="css2/style2.css" type="text/css" media="all">

</head>
<body>
	<div id="header">
		<div>
			<a href="index.php" id="logo"><img src="images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="index.php">Home</a>
				</li>
				<li class="selected">
					<a href="movies.php">Movies</a>
				</li>
					<li>
					<a href="bookticket.php">Book Ticket</a>
				</li>
				<li>
					<a href="registerform.php">Register</a>
				</li>
				<li>
					<a href="loginform.php">Login</a>
				</li>
				<li>
					<a href="contactus.php">Contact Us</a>
				</li>

			</ul>
		</div>
	</div>
	<div id="body" class="movies">

		<h2>Movies</h2>

		<?php
    $film=new Movie();
		$filmat=$film->getAllMovies();
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
				 <p>'.$mdesc.'</p><p><a href="'.$murl.'" style="color:red" >Watch the trailer</a> </p></div>';

			      }
          echo $msg;
		?>
	</div>

<?php include "includes/footer.php";?>
</body>
</html>
