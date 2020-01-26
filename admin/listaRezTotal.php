
<?php
	session_start();

	require_once '../classes/rezervim.php';
	$rezervim=new Rezervim();

	if(isset($_GET['deleteID']))
	{
         $fshiId=$_GET['deleteID'];
		 if($fshiId != null){
		 $rezervim->delete($fshiId);
	     echo '<script>window.alert("U fshi rezervimi");</script>';
		 }
	}

?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website Template</title>
<link href="font-awesome.css" rel="stylesheet" />
<link href="bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="styleadmin3.css" type="text/css">
<script>
function editRezervim(bid,bseats,bstatus)
{
var div=document.getElementById("printoDiv"+bid);
var p='<form method="post"><div class="form-group"><label>Nr Seats : </label><input type="text" style="width:50px;" readonly name="nrVendeve" value="'+bseats+'"/></div>';
p+='<input type="hidden" name="idRezervim" value="'+bid+'"/>';
p+='<div class="form-group"><label>Statusi: </label><input style="width:50px;" type="text" value="'+bstatus+'" name="status" /></div><input type="submit" name="updatebooking" value="Save" class="btn btn-info"/></form>';
div.innerHTML=p;
}

</script>
</head>
<?php
if(isset($_POST['updatebooking'])){
      $nrseats=$_POST['nrVendeve'];
      $status=$_POST['status'];
	  $bid=$_POST['idRezervim'];
	  $rezervim->update($nrseats,$status,$bid);
	  $rezervim->redirect("listaRezTotal.php");
}
?>
<body>
	<div id="header">
		<div class="admboard">
			<a href="index.html" id="logo"><img src="../images/logo.png" alt=""></a>
			      <div class="helloAd">WELCOME ADMIN !</div>
			        <a class="logout" href="../home.php">Log out</a>
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>
	<div id="body" class="Adminboard">

		<div class="panel panel-default" style="margin-bottom:0px;">

						<div class="panel-heading" style="font-size:1.5em;">
                          Bookings list
                        </div>

						<br>


						<div class="panel-body">
                            <div class="table-responsive">
		                           			<?php
							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
<th>#</th><th>Film name</th><th>Show Date</th><th>Show Time</th><th>Kinema</th><th>Salla</th><th>Tech</th><th>Nr.Seats</th>
<th>Total Price</th><th>Reservation Date</th><User><th>Status</th></tr></thead><tbody>';


								if($lista_rez=$rezervim->getAllBookings()){

								 for($i=0;$i<count($lista_rez);$i++)
								 {
								 $bid=$lista_rez[$i][0] 	;
								 $dataRez=$lista_rez[$i][1];
								 $bseats=$lista_rez[$i][2];
								 $bStatus=$lista_rez[$i][3];
								 $data=$lista_rez[$i][4];
								 $ora=$lista_rez[$i][5];
								 $totali=$lista_rez[$i][6]*$bseats;
								 $Emfilm=$lista_rez[$i][7];
								 $Emsalla=$lista_rez[$i][8];
								 $tech=$lista_rez[$i][9];
								 $Emkinema=$lista_rez[$i][10];
								 $Emklient=$lista_rez[$i][11];

			$msg.='<tr><td>'.$bid.'</td><td style="width:20px">'.$Emfilm.'</td><td>'.$data.'</td><td>'.$ora.'</td><td>'.$Emkinema.'</td><td>'.$Emsalla.'</td>
          <td>'.$tech.'</td><td>'.$bseats.'  </td>
		  <td>'.$totali.'</td><td>'.$dataRez.'</td><td>'.$bStatus.'</td><td>'.$Emklient.'</td>
		  <td><a href="listaRezTotal.php?deleteID='.$bid.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>

		  </tr>';
								 }
							 }
								 $msg.="</tbody></table>";
								 echo $msg;
							?>
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
