<?php
	session_start();
	require_once('../dbconfig/config.php');
	require_once '../classes/cinema.php';
	require_once '../classes/theater.php';
	$kinema = new Cinema();
	$salla01=new Theater();
	if(isset($_GET['editID']))
	{
         $editId=$_GET['editID'];
		     $edit_kinema=$kinema->getCinemaById($editId);
	     $cname=$edit_kinema->emri;
       $adresa=$edit_kinema->adresa;
	     $tel=$edit_kinema->tel;
	}
	else
	{
		$cname="";$adresa="";$tel="";
	}
	if(isset($_GET['fshiSalle']))
	{
         $fshiId=$_GET['fshiSalle'];
		 if($fshiId != null){
		 $salla01->delete($fshiId);
	     echo '<script>window.alert("U fshi salla");</script>';
		 }
	}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theater Website Template</title>
	<link href="bootstrap.css" rel="stylesheet" />
<link href="font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="styleadmin3.css" type="text/css">
<script>

function editoSalle(id,emri,tek,kapaciteti)
{
	var div2=document.getElementById("salla_form");
	document.getElementById("salla_form2").innerHTML='';
	var p2='<br><form method="post" action=""><div class="form-group"><label>Id : </label><input required type="text" name="idSalla" value="'+id+'"/></div>';
	p2+='<div class="form-group"><label>Name : </label><input required type="text" name="emSalla" value="'+emri+'"/></div>';
	p2+='<div class="form-group"><label>Technology : </label><input required type="text" name="tech" value="'+tek+'"/></div>';
	p2+='<div class="form-group"><label>Number of seats : </label><input required type="text" value="'+kapaciteti+'" name="nrseats" /></div><input type="submit" name="updatetheater" value="Save theater" class="btn btn-info"/>';
	p2+= '  <input type="submit" name="cancel" value="Cancel" class="btn btn-info" onclick="mbyllEl()"/></form>';
    div2.innerHTML=p2;

}

function shtoSalle(){
	var divi=document.getElementById("salla_form");
	document.getElementById("salla_form2").innerHTML='';
	var p='<br><form method="post" action=""><div class="form-group"><label>Name : </label><input required type="text" name="emSalla" /></div>';
	p+='<div class="form-group"><label>Technology : </label><input required type="text" name="tech" /></div>';
	p+='<div class="form-group"><label>Number of seats : </label><input required type="text" name="nrseats" /></div><input type="submit" name="addtheater" value="Save theater" class="btn btn-info"/>';
	p+='  <input type="submit" name="cancel" value="Cancel" class="btn btn-info" onclick="mbyllEl()"/></form>';
    divi.innerHTML=p;
}
function mbyllEl(div){
	var div2=document.getElementById("salla_form");
	div2.innerHTML='';
	document.getElementById("salla_form2").innerHTML='<input type="submit" name="addtheater" value="Add a theater"  onclick="shtoSalle()" class="btn btn-info"/>';
}

</script>

</head>
<body>
	<div id="header">
		<div class="admboard">
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../index.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>

	<div id="body" class="Adminboard" style="background-color:white;">


		         <div class="panel panel-info" style="width:100%;position:relative;margin-bottom:0px;font-size:1.2em;float:left;">
                         <div class="panel-heading">
                           <?php if(isset($_GET['editID'])) echo 'Cinema Details';
						   else echo 'Add Cinema';
						   ?>
                        </div>


							<a href="admin_clist.php"><input type="submit" style="float:right;margin-top:5px;"value="Back to Cinema Table"  class="btn btn-info"/></a>
                        <div class="panel-body">

                            <form action="" method="post">
							<?php
							    if(isset($_GET['editID'])){
                    echo '<div class="form-group">
                                            <label>Id:</label>
		                                    <input type="text" readonly name="name" size="20" value="'.$editId.'"  />
                                       </div>';
							    }
							?>
										<div class="form-group">
                                            <label>Name:</label>
		                                    <input required type="text" name="cname"  value="<?php echo $cname; ?>"/>
                                       </div>
                                 <div class="form-group">
                                            <label>Adress:</label>
		  <input required type="text" name="adresa" size="20" value="<?php echo $adresa; ?>" />
                                        </div>


                                  <div class="form-group">
<label>Phone Nr:</label>
		    <input type="tel"  name="tel" value="<?php echo $tel; ?>" required placeholder="### ### ####" pattern="06+\d{8}" />
                                    </div>
									<br>
								<table class="table table-striped table-bordered table-hover" style="width:600px;font-size:0.9em;">
								<thead>
								<tr><th colspan="6">Theaters list</th></tr>
								<tr><th>#</th><th>Name</th><th>Technology</th><th colspan="3">Total number of seats</th></tr>
								</thead>
								<tbody>
						<?php if(isset($_GET['editID']))
						{
						       		$msg='';
                              $lista_sallave=$kinema->getAllTheaters();
				 		                 $nr_kinemave=count($lista_sallave);

				 		 			for($i=0;$i<$nr_kinemave;$i++)
								 {
								 $salla_id=$lista_sallave[$i]['Id_salla'];
								 $emriSalla=$lista_sallave[$i]['Em_salla'];
								 $tech=$lista_sallave[$i]['Teknologjia'];
								 $kapaciteti=$lista_sallave[$i]['Kapaciteti'];

			$msg.='<tr><td>'.$salla_id.'</td><td>'.$emriSalla.'</td><td>'.$tech.'</td><td>'.$kapaciteti.'</td>
		  <td><a href="admin_addc.php?editID='.$editId.'&fshiSalle='.$salla_id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><button type="button" class="btn btn-primary" onclick="editoSalle('.$salla_id.',\''.$emriSalla.'\',\''.$tech.'\','.$kapaciteti.')"><i class="fa fa-edit "></i> Edit</button>
		  </td></tr>';

								 }
								 echo $msg;

						}

						?>
									<tr>
									<th colspan="6">
									<?php
									if(isset($_GET['editID']))
									echo '<div id="salla_form"></div><br>
									<div id="salla_form2"><input type="submit" name="addtheater" value="Add a theater"  onclick="shtoSalle()" class="btn btn-info"/></div>
									';
									?>
									</th>
									</tr>
									</tbody></table>

                                      <br><input type="submit" name="submit" value="Save" class="btn btn-info"/>

									   </form>





                        </div>


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
			      $cname=$_POST['cname'];
				    $adresa=$_POST['adresa'];
			      $tel=$_POST['tel'];

						if(isset($_GET['editID'])){
						$kinema->update($cname,$adresa,$tel,$editId);
						echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
						$kinema->redirect("admin_clist.php");
						}
						else
						{
							$kinema->insert($cname,$adresa,$tel);
							echo '<script type="text/javascript"> alert("Cinema is added succesfully !")</script>';
							$kinema->redirect("admin_clist.php");
						}

		   }
		 if(isset($_POST['addtheater']))
		 {
		     $tname=$_POST['emSalla'];
		     $tech=$_POST['tech'];
			   $nrseats=$_POST['nrseats'];
			 $salla01->insert($tname,$nrseats,$tech,$editId);
			 echo '<script type="text/javascript"> alert("Theater is added succesfully !")</script>';
			$kinema->redirect("admin_addc.php?editID=".$editId."");
		 }
      if(isset($_POST['updatetheater']))
		 {
		     $tid=$_POST['idSalla'];
			   $tname=$_POST['emSalla'];
		     $tech=$_POST['tech'];
			   $nrseats=$_POST['nrseats'];
			   $salla01->update($tname,$nrseats,$tech,$editId,$tid);
			 echo '<script type="text/javascript"> alert("Changes are made succesfully !")</script>';
			$kinema->redirect("admin_addc.php?editID=".$editId."");
		 }
?>
