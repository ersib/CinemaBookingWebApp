
<?php
session_start();
if(!isset($_SESSION['admin']))
{
	header('location: ../logimi.php');
}
	require_once '../classes/user.php';
	$user=new User();
	if(isset($_GET['deleteID']))
	{
      $fshiId=$_GET['deleteID'];
		  if($fshiId != null){
		  $user->delete($fshiId);
	     echo '<script>window.alert("U fshi klienti");</script>';
			 $user->redirect("admin_lista_userave.php");
		 }
	}
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Ticket Info - Cinema Theatre Website</title>
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
					<a class="bt" href="admin_board.php">Back to Admin Board</a>
		</div>
	</div>

	<div id="body" class="Adminboard">

		<div class="panel panel-default" style="margin-bottom:0px;">

						<div class="panel-heading" style="font-size:1.5em;">   User Table</div>
						<br>

						<a href="shto_user.php" class="btn btn-info" style="margin-left:20px; text-decoration:none;"> + Add User</a>

					<div style="left:630px;position:relative;">
					   <form method="post">
					   <input type="text" name="input" placeholder="Search by name ..." />
					   <input type="submit" name="search" value="Search" class="btn btn-info"/>
					   </form>
					 </div>

						<div class="panel-body">
                            <div class="table-responsive">
		                           <?php

							$msg='<table class="table table-striped table-bordered table-hover"><thead><tr>
                    <th>#</th><th>Name</th><th>Username</th><th>Phone Nr</th><th>Email</th><th>Birthday</th><th>Adress</th><th>City</th>
                   </tr></thead><tbody>';
               $msg2="";

										if(isset($_POST['search']) && $_POST['input']!='')
								  {
                    $search_input=$_POST['input'];
										$searched_user=new User();
										$searched_user=$user->getUserByName($search_input);

      if($searched_user!=null){
			$msg2='<tr style="color:blue;"><td>'.$searched_user->userId.'</td><td style="width:20px">'.$searched_user->emri.'</td><td>'.$searched_user->username.'</td><td>'.$searched_user->tel.'</td><td>'.$searched_user->email.'</td><td>'.$searched_user->ditelindja.'</td>
          <td>'.$searched_user->adresa.'</td><td>'.$searched_user->qyteti.'</td>

		  <td><a href="admin_lista_userave.php?deleteID='.$searched_user->userId.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="shto_user.php?editID='.$searched_user->userId.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		 <td><a href="listaRezPerUserin.php?userID='.$searched_user->userId.'"><button class="btn btn-primary" style="background-color:#f0ad4e;border:none;">Bookings list</button></td>
		  </tr>';

								  if($searched_user->emri=="")
								  $msg2="";
								  }
               }
								 $msg.=$msg2;

                 $users_list=$user->getAllUsers();
								 for($i=0;$i<count($users_list);$i++)
								 {
								 $Id=$users_list[$i]['Id_klient'];
								 $Emri=$users_list[$i]['Em_klient'];
								 $username=$users_list[$i]['username'];
								 $tel=$users_list[$i]['Nr_tel'];
								 $email=$users_list[$i]['Email'];
								 $ditelindja=$users_list[$i]['Ditelindja'];
								 $adresa=$users_list[$i]['Adresa'];
								 $qyteti=$users_list[$i]['Qyteti'];

			$msg.='<tr><td>'.$Id.'</td><td style="width:20px">'.$Emri.'</td><td>'.$username.'</td><td>'.$tel.'</td><td>'.$email.'</td><td>'.$ditelindja.'</td>
          <td>'.$adresa.'</td><td>'. $qyteti.'</td><td><a href="admin_lista_userave.php?deleteID='.$Id.'"><img width="20px" height="20px" src="../images/trashbin.jpg" /><a></td>
		  <td><a href="shto_user.php?editID='.$Id.'"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button></td>
		  <td><a href="listaRezPerUserin.php?userID='.$Id.'"><button class="btn btn-primary" style="background-color:#f0ad4e;">Bookings list</button></td>
		  </tr>';
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
