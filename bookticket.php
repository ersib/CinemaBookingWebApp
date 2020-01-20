
<script>
        window.alert("You must sign in first !")
        window.location.href="loginform.php";
</script>

<!--
<html>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Book Ticket - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="css2/style2.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<a href="index.php" id="logo"><img src="images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="movies.php">Movies</a>
				</li>
					<li class="selected">
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
	<div id="body" class="ticket-info">
		<h2 style="text-align:center;">All movies</h2>
				<hr style="border:1px solid #4F4F4F;"/>





		require_once 'classes/movie.php';
		$film=new Movie();
		$filmat=$film->getAllMovies();
		$nr_filmave=count($filmat);
		$msg='<div class="container_book">';

            for($i=0;$i<$nr_filmave;$i++)
            {

                  $msg.= '<div class="movielist"><div class="titleM"><p>'.$filmat[$i]['Titull_film'].'</p></div>
		<div class="photoM"><img src="data:image/jpeg;base64,'.base64_encode($filmat[$i]['Imazhi_film']).' alt="poster filmi"></img></div>

		   <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div></div>';

			   }


		$msg.='</div>';

echo $msg;


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
-->
