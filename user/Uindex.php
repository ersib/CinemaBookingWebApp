<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Cinema Theater Website Template</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css">
	<link rel="stylesheet" href="ustyle.css" type="text/css">
</head>

<body>
	<div id="header">
		<div>
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li class="selected">
					<a href="Uindex.php">Home</a>
				</li>
				<li>
					<a href="Umovies.php">Movies</a>
				</li>
				<li>
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
	<div id="body" class="home">

		<div id="homeWall">
		<h2><a>Movies</a></h2>
		<?php
		require_once '../classes/movie.php';

			$film=new Movie();
			$filmat=$film->getAllMovies();
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
			<div>
				<h3><a href="rentals.html">Recent News</a></h3>
				<ul>
					<li>
						<a href="rentals.html"><img src="../images/conference.jpg" alt=""></a>
						<h4>News 1</h4>
						<p>
							In sed nibh mauris. Curabitur scelerisque dignissim viverra. Etiam interdum enim nec turpis.
						</p>
					</li>
					<li>
						<a href="rentals.html"><img src="../images/cinema.jpg" alt=""></a>
						<h4> News 2</h4>
						<p>
							Donec odio nunc, consectetur fringilla tincidunt nec, cursus vitae ipsum.
						</p>
					</li>
				</ul>
			</div>
			<div>
				<h3><a href="blog.html">Advertisements</a></h3>
				<ul>
					<li>
						<a href="blog.html"><img src="../images/trainor.jpg" alt=""></a>
						<div>
							<span>Posted on August 8, 2023 by Admin</span>
							<h4>Advertisement One</h4>
							<p>
								Donec odio nunc, consectetur fringilla tincidunt nec, cursus vitae ipsum. <a href="blog.html" class="more">Read More</a>
							</p>
						</div>
					</li>
					<li>
						<a href="blog.html"><img src="../images/lava.jpg" alt=""></a>
						<div>
							<span>Posted on August 8, 2023 by Admin</span>
							<h4>Advertisement Two</h4>
							<p>
								Donec odio nunc, consectetur fringilla tincidunt nec, cursus vitae ipsum. <a href="blog.html" class="more">Read More</a>
							</p>
						</div>
					</li>
					<li>
						<a href="blog.html"><img src="../images/castle.jpg" alt=""></a>
						<div>
							<span>Posted on August 8, 2023 by Admin</span>
							<h4>Advertisement Three</h4>
							<p>
								Donec odio nunc, consectetur fringilla tincidunt nec, cursus vitae ipsum. <a href="blog.html" class="more">Read More</a>
							</p>
						</div>
					</li>
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
