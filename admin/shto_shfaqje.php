<?php
	session_start();
	
	require_once '../classes/shfaqje.php';
		require_once '../classes/film.php';
				require_once '../classes/kinema.php';
					require_once '../classes/salla.php';
	$shfaqje = new Shfaqje();

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

	<div id="body" class="Adminboard" style="background-color:white;">


		         <div class="panel panel-info" style="width:100%;position:relative;margin-bottom:0px;font-size:1.2em;float:left;">
                         <div class="panel-heading">
                           <?php if(isset($_GET['editID'])) echo 'Show Details';
						   else echo 'Add show';
						   ?>
                        </div>

							<a href="lista_shfaqjeve.php"><input type="submit" style="float:right;margin-top:5px;"value="Back to Shows Table"  class="btn btn-info"/></a>
                        <div class="panel-body">


							<?php
							    if(isset($_GET['editID'])){
                                        echo '<div class="form-group">
                                            <label>Id:</label>
		                                         <input type="text" readonly name="name" size="20" value="'.$editId.'"  />
                                       </div>';
							    }
							?>		  <form method="post">
										<div class="form-group"><br/><br/>
                      <label>Please choose the movie you want to arrange a show:</label><br/><br/>
											<?php
											$msg="";
											       /*$sql="SELECT movies2.Id_film,movies2.Titull_film,movies2.Imazhi_film FROM movies2";
												   $res=mysqli_query($con,$sql);
												   if(!$res)
													   echo '<script>alert("ka gabimm")</script>';
														 */
														 $film=new Film();
														 $filmat=$film->getAllFilms();
												   for($i=0;$i<count($filmat);$i++){
								$msg.='<input  type="radio" name="mTitle"  value="'.$filmat[$i]['Id_film'].'"/> <span style="margin-right:25px;"><span>"'.$filmat[$i]['Titull_film'].'"</span>
								<img style="width:60px;height:75px;margin-bottom:15px;" src="data:image/jpeg;base64,'.base64_encode($filmat[$i]['Imazhi_film']).' alt="poster"></img>
								</span>
								';
												   }
												   echo $msg;
											?>
                   </div>

                      <input type="submit" name="submitM" value="Choose the movie" class="btn btn-info"/>
									   </form>
									   <br>
                  <?php

									  if(isset($_POST['submitM']))
									  {

										$idfilm=$_POST['mTitle'];
										$_SESSION['filmID']=$idfilm;
										$film=$film->getFilmById($idfilm);
									  $sallaForm='<div class="form-group">Now please select the theater for the show about " '.$film->titulli.' " movie :<br>
									  <form  method="post">';
		                $sallaForm.='<label>Choose the cinema :   </label><select name="Em_kino">';

                   $kinema=new Kinema();
					         $list_kinema=$kinema->getAllKinemas();

						             for($i=0;$i<count($list_kinema);$i++){
                          $sallaForm.='<option value="'.$list_kinema[$i]['Id_kinema'].'">'.$list_kinema[$i]['Em_kinema'].'</option>';
                         }
						               $sallaForm.='</select><br/><br><input type="submit" name="submitC" value="Choose the cinema" class="btn btn-info"/></div></form>';
                         	echo $sallaForm;

									  }

									   if(isset($_POST['submitC']))
									  {
										   $cID=$_POST['Em_kino'];
                       $msg4="Choose the theater and also fill the date and time:<br><br><form action='' method='post'>";
		                  $salla=new Salla();
						          $list_salla=$salla->getAllSallasByCinemId($cID);

                      for($i=0;$i<count($list_salla);$i++){
								    $msg4.='<input type="radio" name="salla" value="'.$list_salla[$i]['Id_salla'].'">'.$list_salla[$i]['Em_salla'].' | Nr.seats:'.$list_salla[$i]['Kapaciteti'].' |Tech:'.$list_salla[$i]['Teknologjia'].'<br>';
			             }

							 echo $msg4;

									  ?>
			<br><div class="form-group">
		<label>Date of show:</label>
		  <input type="date"  name="datashfaqjes"  /> </div>
		  <div class="form-group">
		  <label>Time of show:</label>
		  <select name="kohaeshfaqjes">
		  <option>15:00</option>
		  <option>17:00</option>
		  <option>19:00</option>
		  <option>20:00</option>
		  <option>21:00</option>
		  </select>
		  </div>
		   <div class="form-group">
		  <label>Price of a ticket:</label>
		  <input type="text"  name="cmimi"  />
		  </div>
		    <input class="btn btn-info"  type="submit" name="submit3" id="submit3" value="Add show" />
           </form>
		  <?php
			}
		   	    if(isset($_POST['submit3']))
					 {

			                       if(!empty($_POST['salla']) && !empty($_POST['datashfaqjes']) && !empty($_POST['kohaeshfaqjes']) )
                             {

					                            $SallaID =$_POST['salla'];
                                     $DitaSH=$_POST['datashfaqjes'];
                                     $KohaSH =$_POST['kohaeshfaqjes'];
									                   $cmimi=$_POST['cmimi'];
                                     $filmID=$_SESSION['filmID'];

								                if($shfaqje->isValidShowTime($DitaSH,$KohaSH,$SallaID))
				                       {
						                            if($shfaqje->insert($DitaSH,$KohaSH,$cmimi,0,'Free seats',$SallaID,$filmID))
                              echo "<script>alert('Show successfully added');window.location.href='lista_shfaqjeve.php'; </script>";
                                        else
                                        echo "<script>window.alert('ka deshtuar');</script>";
				                       }
				                      else
                                   echo "<scrp>window.alert('Ka nje tjeter shfaqje ne kete orar ne kete salle');</script>";

 	                         }
      		                   else
                              {
                              echo "All fields are required!";
                              }
						   }

		  ?>





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
