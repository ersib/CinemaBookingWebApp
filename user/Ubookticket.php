<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Book Ticket - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css">
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
	<div id="body" class="ticket-info">
		<h2 style="text-align:center;">All movies</h2>
				<hr style="border:1px solid #4F4F4F;"/>
		<!--<br/>
		<ul>
		<li><span class="mbooked" >
		   <p >Movie 1<p>
		 <div class="prv1"><img src="images/ballet-dancer3.jpg" class="fotobooked"></img></div>
		 <div class="prv2"><a href="bookticket.html">Book Ticket</div>
		</span></li>
		<li><span class="mbooked">
		   <p >Movie 2<p>
		 <div class="prv1"><img src="images/baby-with-dog.jpg" class="fotobooked"></img></div>
		 <div class="prv2"><a href="bookticket.html">Book Ticket</div>
		</span></li>
		<li><span class="mbooked">
		   <p >Movie 3<p>
		 <div class="prv1"><img src="castle2.jpg" class="fotobooked"></img></div>
		 <div class="prv2"><a href="bookticket.html">Book Ticket</div>
		</span></li>
		</ul>-->



		<!--<div class="container_book">-->


		<?php
		$conn=mysqli_connect("localhost","root","","cinemadb");
		$msg='<div class="container_book">';
		$sql="select * from movies2";
        if(mysqli_query($conn,$sql))
        {
            $res=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($res))
            {

                     $mname=$row['Titull_film'];
                    $mimage=$row['Imazhi_film'];

                  $msg.= '<div class="movielist"><div class="titleM"><p>'.$row['Titull_film'].'</p></div>
		<div class="photoM"><img src="data:image/jpeg;base64,'.base64_encode($row['Imazhi_film']).' alt="poster filmi"></img></div>

		   <div class="buton">
		  <a href="bookTicket.php?filmId='.$row['Id_film'].'"><input type="button" name="buton" value="Book ticket"/></a></div></div>';

			}


      }
        else{
            echo '<script type="text/javascript"> alert("Error !")</script>';
		}
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
