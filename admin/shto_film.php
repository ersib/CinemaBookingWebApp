<?php
	session_start();

	require_once '../classes/film.php';
	$film = new Film();

	if(isset($_GET['editID']))
	{
         $editId=$_GET['editID'];
		     $edit_film=$film->getFilmById($editId);

		$Id=$edit_film->filmId;
		$Emri=$edit_film->titulli;
		$rdate=$edit_film->data;
		$koha=$edit_film->koha;
		$zhanri=$edit_film->zhanri;
		$kasti=$edit_film->kasti;
		$desc=$edit_film->desc;
		$regjizor=$edit_film->regj;
		$trailer=$edit_film->url;
		$img=$edit_film->imazh;
		$Wimg=$edit_film->poster;
	}
	else
	{
		$Emri="";
		$rdate="";
		$koha="";
		$zhanri="";
		$kasti="";
		$desc="";
		$img="";
		$Wimg="";
$regjizor="";
		$trailer="";
	}
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
	<link href="bootstrap.css" rel="stylesheet" />
<link href="font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="styleadmin3.css" type="text/css">
</head>
<body>
	<div id="header">
		<div class="admboard">
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../home.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>

	<div id="body" class="Adminboard" >
		<div class="panel panel-default" style="margin-bottom:0px;">


		         <div class="panel panel-info" style="width:100%;position:relative;font-size:1.2em;">
                         <div class="panel-heading">

                           <?php if(isset($_GET['editID'])) echo 'Film Details';
						   else echo 'Add Film';
						   ?>
						   	<a href="lista_filmave.php"><input type="submit" style="background-color:#008000;float:right;"value="Back to Movies Table"  class="btn btn-info"/></a>
                        </div>

                        <div class="panel-body">

                            <form action="" method="post" enctype="multipart/form-data">
							<?php
							    if(isset($_GET['editID'])){
                                        echo '<div class="form-group">
                                            <label>Id:</label>
		                                    <input type="text" readonly name="name" size="20" value="'.$editId.'"  />
                                       </div>';
							    }
							?>

										<div class="form-group">
                                            <label>Film title :</label>
		                                    <input type="text" name="mname" value="<?php echo $Emri; ?>"/>
                                       </div>

									   <div class="form-group">
                                          <label>Release date :</label>
                                          <input class="form-control" style="width:150px;" name="rdate"  type="date"/>
										  <?php if(isset($_GET['editID']))
											  echo '( Current : '.$rdate.' )<br>';?>
										  </div>
                                 <div class="form-group">
                                            <label>Duration :</label>
											<input type="text" value="<?php echo $koha; ?>" name="koha" size="4" required  />

                                        </div>
                                        <div class="form-group">
                                            <label>Genre :</label>
		                                    <input type="text" required name="zhanri" value="<?php echo $zhanri; ?>" />
                                        </div>
										 <div class="form-group">
                                             <label>Cast :</label><br>
											  <textarea  name="kasti" cols="20" rows="3"><?php echo $kasti; ?></textarea>

                                        </div>

                                  <div class="form-group">
                                 <label>Description:</label><br>
		    <textarea  name="desc" cols="50" rows="5"><?php echo $desc; ?></textarea>

                                    </div>
									     <div class="form-group">
                                            <label>Director :</label>
		                                    <input type="text" required name="regjizori" value="<?php echo $regjizor; ?>" />
                                        </div>
										 <div class="form-group">
                                             <label>Trailer :</label>
											  <input required type="text" name="trailerurl"  value="<?php echo $trailer; ?>"/>
                                        </div>

										<div class="form-group">
                                          <label>Film poster :</label><br>
										  <?php if(isset($_GET['editID']))
											echo '<img style="width:100px;height:125px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img>';
										  ?>
		                               <input type="file" name="image" accept="image"/>
                                        </div>
										<div class="form-group">
                                          <label>Wall image:</label><br>
                                          <?php if(isset($_GET['editID']))
											echo '<img style="width:200px;height:150px;" src="data:image/jpeg;base64,'.base64_encode($Wimg).' alt="poster"></img>';
										  ?>
		                               <input type="file" name="Wimage" accept="image"/>
                                        </div>

                                       <br><input type="submit" name="submit" value="Save" class="btn btn-info"/><br><br>

									   </form>





                        </div>


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
<?php
      if(isset($_POST['submit']))
		   {
			     if(getimagesize($_FILES['image']['tmp_name']))
					 {
		               $fp = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					 }
					 else
						 $fp=null;

					  if(getimagesize($_FILES['Wimage']['tmp_name']))
					 {
  					       $Wimg = addslashes(file_get_contents($_FILES['Wimage']['tmp_name']));
					  }
					  else
						  $Wimg=null;


					            $movname =$_POST['mname'];
                      $movDate=$_POST['rdate'];
                      $movTime =$_POST['koha'];
                      $movGenre =$_POST['zhanri'];
                      $movCast=$_POST['kasti'];
                      $movDir=$_POST['regjizori'];
					            $movDesc=$_POST['desc'];
					            $movURL=$_POST['trailerurl'];

						if(isset($_GET['editID']) && !isset($_POST['rdate'])){
							echo '<script type="text/javascript"> alert("u futem ne update pa date !")</script>';
						  $film->update($movname,null,$movTime,$movGenre,$movCast,$movDesc,$movDir,$movURL,$fp,$Wimg,$editId);
						  $film->redirect("lista_filmave.php");
						  echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
						}
						else if(isset($_GET['editID']) && isset($_POST['rdate'])){
								echo '<script type="text/javascript"> alert("u futem ne update me date !")</script>';
						  $film->update($movname,$movDate,$movTime,$movGenre,$movCast,$movDesc,$movDir,$movURL,$fp,$Wimg,$editId);
						  echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
							$film->redirect("shto_film.php?editID=".$editId."");
						}
						else
						{
							echo '<script type="text/javascript"> alert("u futem ne insert !")</script>';
							$film->insert($movname,$movDate,$movTime,$movGenre,$movCast,$movDesc,$movDir,$movURL,$fp,$Wimg);
							echo '<script type="text/javascript"> alert("User is added succesfully !")</script>';
							$film->redirect("lista_filmave.php");
						}

		   }

?>
