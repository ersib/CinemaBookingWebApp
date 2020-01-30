<?php
session_start();
if(!isset($_SESSION['admin']))
{
	header('location: ../logimi.php');
}
	require_once '../classes/reklame.php';
	$reklame = new Reklame();

	if(isset($_GET['editID']))
	{
         $editId=$_GET['editID'];
     $row=$reklame->getReklameMeID($editId);
		$Id=$row['Id_ads'];
		$title=$row['Titulli_ads'];
		$desc=$row['Permbajtja'];
		$img=$row['Imazh_ads'];

	}
	else
	{
		$title="";
		$desc="";
		$date="";
		$img="";
	}
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website</title>
	<link href="bootstrap.css" rel="stylesheet" />
<link href="font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="styleadmin3.css" type="text/css">
</head>
<body>
	<div id="header">
		<div class="admboard">
			<a  id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../logout.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>

	<div id="body" class="Adminboard" >
		<div class="panel panel-default" style="margin-bottom:0px;">


		         <div class="panel panel-info" style="width:100%;position:relative;font-size:1.2em;">
                         <div class="panel-heading">

                           <?php if(isset($_GET['editID'])) echo 'Ads Details';
						   else echo 'Add advertisement';
						   ?>
						   	<a href="lista_njoftimeve.php"><input type="submit" style="background-color:#008000;float:right;"value="Back to News/Advertisement Table"  class="btn btn-info"/></a>
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
                                            <label>Advertisement title :</label>
		                                    <input type="text" name="title" value="<?php echo $title; ?>"/>
                                       </div>

                                  <div class="form-group">
                                 <label>Description:</label><br>
		    <textarea  name="desc" cols="50" rows="5"><?php echo $desc; ?></textarea>

                                    </div>

										<div class="form-group">
                                          <label>Advertisement Image :</label><br>
										  <?php if(isset($_GET['editID']))
											echo '<img style="width:100px;height:125px;" src="data:image/jpeg;base64,'.base64_encode($img).' alt="poster"></img>';
										  ?>
		                               <input type="file" name="image" accept="image"/>
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
		    // echo '<script type="text/javascript"> alert("Submit button clicked'.$editId.'")</script>'; // kur shtyp submit del alert qe sapo e ke shtypur butonin
			          if(getimagesize($_FILES['image']['tmp_name']))
					 {
						echo '<script type="text/javascript"> alert("Po merret posteri ")</script>';
		               $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					 }
					 else
						 $img=null;
					   //$res=mysqli_query($con,"UPDATE movies2 SET Imazhi_film='$fp' WHERE Id_film='$editId'");


					  $title =$_POST['title'];
                      $desc=$_POST['desc'];

						if(isset($_GET['editID'])){
							 // echo '<script type="text/javascript"> alert("Po ruhen ndryshimet !")</script>';
						$reklame->update($title,$desc,$img,$editId);
						$reklame->redirect("lista_njoftimeve.php");
						echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';

						}
						else
						{
							$reklame->insert($title,$desc,$img);
							echo '<script type="text/javascript"> alert("Advertisement is added succesfully !")</script>';
							$reklame->redirect("lista_njoftimeve.php");
							//}
							/*else{
								echo '<script type="text/javascript"> alert("The password doesn\'t match !")</script>';
							}*/
							//}
						}

		   }

?>
