<?php/*
	session_start();
	require_once('dbconfig/config.php');
	
*/?>
<?php
				  $conn=mysqli_connect("localhost","root","","cinemadb");
				
				?>
				
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	
	<!--------------------------------------------------------------------------->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--------------------------------------------------------------------------->
	<title>Movies - Cinema Theater Website Template</title>
	<link rel="stylesheet" href="../css2/style2.css" type="text/css" media="all">
	<link rel="stylesheet" href="ustyle.css" type="text/css">
	<link href="css/showYtVideo.css" rel="stylesheet" type="text/css">

</head>
<body>
	<div id="header">
		<div>
			<a href="Uindex.php" id="logo"><img src="../images/logo.png" alt=""></a>
			<ul>
				<li>
					<a href="Uindex.php">Home</a>
				</li>
				<li class="selected">
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
	<div id="body" class="movies">
	
		<h2>Movies</h2>
		
		
		<?php
		$msg="";
		$sql="select * from movies2";
        if(mysqli_query($conn,$sql))
        {
            $res=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($res))
            {       
		            
                     $mname=$row['Titull_film'];
                    $mdate=$row['Data_fillimit'];
                    $mtime=$row['Kohezgjatja'];
                    $mgenre=$row['Zhanri'];
                    $mcast=$row['Kasti'];
					$mdesc=$row['Pershkrim'];
					$mdir=$row['Regjisori'];
					$murl=$row['TrailerUrl'];
                    $mimage=$row['Imazhi_film'];
					
                  $msg.= '<div class="filmi"><a href="#"><img src="data:image/jpeg;base64,'.base64_encode($row['Imazhi_film']).' alt ="name_of_movie" ></a>';
				  $msg.='<h3>'.$row['Titull_film'].'</h3><p class="RD">Release Date :'.$row['Data_fillimit'].'</p><p> Duration :'.$row['Kohezgjatja'].'</p>
				 <p><em>Director</em> :'.$row['Regjisori'].'</p><p>Cast :'.$row['Kasti'].'</p><p>Genre :'.$row['Zhanri'].'</p><p>Description:</p>
				 <p>'.$row['Pershkrim'].'</p><p><a href="'.$row['TrailerUrl'].'">Watch the trailer</a> </p></div>';
                  
			}	 
            
			
      }
        else{
            echo '<script type="text/javascript"> alert("Error !")</script>';
		}
		
echo $msg;
		?>
		<!--
		<ul>
			<li>
				<a href="movie-details.html"><img src="images/joker.jpg" alt=""></a>
				<h3>Joker</h3>
				<p>
					This website template has been designed by Free Website Templates for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you're free to use this website template without linking back to us. If you're having problems editing this websitetemplate, then don't hesitate to ask for help on the Forums. You can replace all this text.
				</p>
				
				<button  id="JwMKRevYa_M" type="button" class="show-video">Play Trailer</button>
				
			</li>
			<li>
				<a href="movie-details.html"><img src="images/surfers.jpg" alt=""></a>
				<h3>Movie Title</h3>
				<p>
					This website template has been designed by Free Website Templates for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you're free to use this website template without linking back to us. If you're having problems editing this websitetemplate, then don't hesitate to ask for help on the Forums. You can replace all this text.
				</p>
				<a href="movie-details.html">Read More</a>
				
				<a href="movie-details.html" ><img  src="data:image/jpeg;base64, <?php echo base64_encode( $row['Imazhi_film']);?> " alt ="name_of_movie" /> </a>
                <h3><?php echo $mname ?></h3>
                 <p><?php echo $mdesc ?></p> 
			         
           <button  id="JwMKRevYa_M" type="button" class="show-video">Play Trailer</button>
			</li>
			<li>
				<a href="movie-details.html"><img src="images/soldiers2.jpg" alt=""></a>
				<h3>Movie Title</h3>
				<p>
					This website template has been designed by Free Website Templates for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you're free to use this website template without linking back to us. If you're having problems editing this websitetemplate, then don't hesitate to ask for help on the Forums. You can replace all this text.
				</p>
				<a href="movie-details.html">Read More</a>
			</li>
			<li>
				<a href="movie-details.html"><img src="images/ballet-dancer2.jpg" alt=""></a>
				<h3>Movie Title</h3>
				<p>
					This website template has been designed by Free Website Templates for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you're free to use this website template without linking back to us. If you're having problems editing this websitetemplate, then don't hesitate to ask for help on the Forums. You can replace all this text.
				</p>
				<a href="movie-details.html">Read More</a>
			</li>
		</ul>-->
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
	
	<script src="js/jquery.showYtVideo.js"></script><!-- link to java script-->
	
<script>

 jQuery(document).ready(function ($) {
            $('.show-video').on('click', function () {
			     var id = this.id;

                $.showYtVideo({
                    videoId: id
                });
            });
        });
</script>
	
</body>
</html>