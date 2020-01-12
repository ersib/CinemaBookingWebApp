<?php
	session_start();
//	require_once('dbconfig/config.php');
	
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
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
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../index.php">Log out</a>
		</div>
	</div>
	<div id="body" class="Adminboard" style="background-color:#fceecc;">
	        <br>
		<img src="../images/ABM.png" style="width:230px;height:50px;margin-left:140px;"> <br/> <br>
			
			<!--<h1 class="banner">ADMIN BOARD</h1>-->
        <!--<br>
		<div class="Board">
		<div class="menutitle"> Users </div>
		<a class="iBoard" href="admin_ulist.php">View users list</a>
	    <a class="iBoard" href="admin_adduser.php">Add a user</a>
		<a class="iBoard" href="#">Remove a user</a>
		<a class="iBoard" href="#">Book report</a>
		</div>
		<div class="Board">
		<div class="menutitle"> Movies </div>
		<a class="iBoard" href="admin_mlist.php">View movies list</a>
	    <a class="iBoard" href="admin_addfilm.php">Add a movie</a>
		<a class="iBoard" href="#">Remove a movie</a>
		<a class="iBoard" href="#">Edit a movie</a>
		</div>
		
		<div class="Board">
		<div class="menutitle"> Cinema </div>
		<a class="iBoard" href="admin_addcinema">Add a cinema</a>
		<a class="iBoard" href="#">Delete a cinema</a>
		 <a class="iBoard" href="admin_news.php">Add news/notification </a>
		<a class="iBoard" href="#">Delete news/notification</a>
		 <a class="iBoard" href="admin_ads.php">Add an advertisement</a>
		<a class="iBoard" href="#">Delete an advertisement</a>
		</div>
	    
		<div class="Board">
		<div class="menutitle" style="width:220px; left:30%;"> Movie shows </div>
		<a class="iBoard" href="3">View shows list</a>
	    <a class="iBoard" href="addshow.php">Add a show</a>
		<a class="iBoard" href="#">Delete a show</a>
		<br><br>
		</div>
		-->
		        <div class="row" style="position:relaitve;margin-left:100px;margin-bottom:10px;">
            
                 <div class="col-md-3 col-sm-3 col-xs-6"><a href="admin_ulist.php" style="text-decoration:none;">
                      <div class="alert alert-info back-widget-set text-center">      <br/>      
                          <img src="../images/userpro.jpg" style="width:100px;height:120px;margin-left:47px;"> <br/> 
                          <div> Users Info</div>
                        </div></a>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6"><a href="admin_clist.php" style="text-decoration:none;">
                      <div class="alert alert-info back-widget-set text-center">      <br/>      
                          <img src="../images/cinemaM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/> 
                          <div> Cinemas and theaters</div>
                        </div></a>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6"><a href="admin_mlist.php" style="text-decoration:none;">
                      <div class="alert alert-warning back-widget-set text-center"><br/>     
                          <img src="../images/moviesM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/> 
                          <div> Movies </div>  
                        </div></a>
                    </div>         
                </div>   
				<div class="row" style="position:relaitve;margin-left:100px;">
				<div class="col-md-3 col-sm-3 col-xs-6"><a href="admin_shlist.php" style="text-decoration:none;">
                      <div class="alert alert-danger back-widget-set text-center"><br/>
                             <img src="../images/showsM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/> 
                          <div> Shows </div> 
                        </div></a>
                    </div>
					<div class="col-md-3 col-sm-3 col-xs-6"><a href="admin_blist.php" style="text-decoration:none;">
                      <div class="alert alert-info back-widget-set text-center">      <br/>      
                          <img src="../images/bookingM.jpg" style="width:130px;height:120px;margin-left:30px;"> <br/> 
                          <div> All bookings </div>
                        </div></a>
                    </div>
					<div class="col-md-3 col-sm-3 col-xs-6"><a href="admin_newslist.php" style="text-decoration:none;">
                      <div class="alert alert-danger back-widget-set text-center"><br/>
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