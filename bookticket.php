<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<?php


	echo '<script>window.alert("Duhet te regjistrohesh me pare")</script>';
  //header("location:loginform.php");

?>
<html>
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



		<?php
		require_once 'classes/movie.php';
		$film=new Movie();
		$filmat=$film->getAllMovies();
		$nr_filmave=count($filmat);
		//$conn=mysqli_connect("localhost","root","","cinemadb");
		$msg='<div class="container_book">';
		//$sql="select * from movies2";
    //    if(mysqli_query($conn,$sql))
    //    {
            //$res=mysqli_query($conn,$sql);
            for($i=0;$i<$nr_filmave;$i++)
            {

                  $msg.= '<div class="movielist"><div class="titleM"><p>'.$filmat[$i]['Titull_film'].'</p></div>
		<div class="photoM"><img src="data:image/jpeg;base64,'.base64_encode($filmat[$i]['Imazhi_film']).' alt="poster filmi"></img></div>

		   <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div></div>';

			   }


  //    }
    //    else{
    //        echo '<script type="text/javascript"> alert("Error !")</script>';
		//      }
		$msg.='</div>';

echo $msg;
		?>

	 <!--
	    <div class="movielist">
	       <div class="titleM"><p>Movie 1</p></div>
		   <div class="photoM"><img src="images/baby-with-dog.jpg"></img></div>

		   <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div>
	    </div>

		<div class="movielist">
	       <div class="titleM"><p>Movie 2</p></div>
		   <div class="photoM"><img src="images/ballet-dancer.jpg"></img></div>

			  <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div>
	    </div>

		<div class="movielist">
	      <div class="titleM"><p>Movie 3</p></div>
		  <div class="photoM"><img src="images/soldiers.jpg"></img></div>

		    <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div>
	    </div>

		<div class="movielist">
	      <div class="titleM"><p>Movie 4</p></div>
		  <div class="photoM"><img src="images/surfer.jpg"></img></div>
	      <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div>
	    </div>

		<div class="movielist">
	      <div class="titleM"><p>Movie 5</p></div>
		  <div class="photoM"><img src="images/trainor.jpg"></img></div>
	     <div class="buton">
		  <input type="button" name="buton" value="Book ticket"/></div>
	    </div>-->


	   <!-- </div>-->




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
