<?php
session_start();
if(!isset($_SESSION['admin']))
{
	header('location: ../logimi.php');
}


?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link href="font-awesome.css" rel="stylesheet" />
<link href="bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="styleadmin3.css" type="text/css">

</head>
<body>
	<div id="header">
		<div class="admboard">
			<a  id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../logout.php">Log out</a>
		</div>
	</div>
	<div id="body" class="Adminboard" style="background-color:#fceecc;">
	        <br>
		<img src="../images/ABM.png" style="width:230px;height:50px;margin-left:140px;"> <br/> <br>

		        <div class="rreshti" style="position:relaitve;margin-left:100px;margin-bottom:10px;">

                 <div class="element_menu"><a href="admin_lista_userave.php" style="text-decoration:none;">
                      <div class="element_figure">      <br/>
                          <img src="../images/userpro.jpg" style="width:100px;height:120px;margin-left:47px;"> <br/>
                          <div> Users Info</div>
                        </div></a>
                    </div>
               <div class="element_menu"><a href="lista_kinemave.php" style="text-decoration:none;">
                      <div class="element_figure">      <br/>
                          <img src="../images/cinemaM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/>
                          <div> Cinemas and theaters</div>
                        </div></a>
                    </div>
               <div class="element_menu"><a href="lista_filmave.php" style="text-decoration:none;">
                      <div class="element_figure"><br/>
                          <img src="../images/moviesM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/>
                          <div> Movies </div>
                        </div></a>
                    </div>
                </div>
				<div class="rreshti" style="position:relaitve;margin-left:100px;">
				<div class="element_menu"><a href="lista_shfaqjeve.php" style="text-decoration:none;">
                      <div class="element_figure"><br/>
                             <img src="../images/showsM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/>
                          <div> Shows </div>
                        </div></a>
                    </div>
					<div class="element_menu"><a href="listaRezTotal.php" style="text-decoration:none;">
                      <div class="element_figure">      <br/>
                          <img src="../images/bookingM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/>
                          <div> All bookings </div>
                        </div></a>
                    </div>
					<div class="element_menu"><a href="lista_njoftimeve.php" style="text-decoration:none;">
                      <div class="element_figure"><br/>
                             <img src="../images/NewsM.png" style="width:130px;height:120px;margin-left:30px;"> <br/>
                          <div> News / Advertisemenets </div>
                        </div></a>
                    </div>
				</div>
<br><br>
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
