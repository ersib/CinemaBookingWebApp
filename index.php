<?php
require_once 'classes/movie.php';
require_once 'dbconfig/config.php';
$film=new Movie();
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Cinema Theater Website Template</title>
	<link rel="stylesheet" href="css2/style2.css" type="text/css">

</head>

<body>

  <?php include "includes/headers.php";	?>

	<div id="body" class="home" style="background-color:#fdf7e8;color:black;">

		<div id="homeWall">
		<h2><a>Movies</a></h2>

		<?php
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
			<?php
			$sql="select * from news2";
        if(mysqli_query($con,$sql))
        {
            $res=mysqli_query($con,$sql);
			?>
				<h3><a>Recent News</a></h3>
				<ul>
			<?php
				   while($row=mysqli_fetch_array($res)){
			      $foto=$row['Imazh_news'];
		        $titulli=$row['Titulli_news'];
				    $desc=$row['Pershkrimi_news'];

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

      }
        else{
            echo '<script type="text/javascript"> alert("Error !")</script>';
		}
		?>


				</ul>
			</div>
			<div>
				<h3><a href="blog.html">Advertisements</a></h3>
				<ul>
					<li>
						<a href="blog.html"><img src="images/trainor.jpg" alt=""></a>
						<div>
							<span>Posted on August 8, 2023 by Admin</span>
							<h4>Advertisement One</h4>
							<p>
								Donec odio nunc, consectetur fringilla tincidunt nec, cursus vitae ipsum. <a href="blog.html" class="more">Read More</a>
							</p>
						</div>
					</li>
					<li>
						<a href="blog.html"><img src="images/lava.jpg" alt=""></a>
						<div>
							<span>Posted on August 8, 2023 by Admin</span>
							<h4>Advertisement Two</h4>
							<p>
								Donec odio nunc, consectetur fringilla tincidunt nec, cursus vitae ipsum. <a href="blog.html" class="more">Read More</a>
							</p>
						</div>
					</li>
					<li>
						<a href="blog.html"><img src="images/castle.jpg" alt=""></a>
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

	<?php include "includes/footer.php";?>
</body>
</html>
