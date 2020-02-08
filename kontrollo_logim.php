<?php
require 'classes/user.php';
if(isset($_POST['submit']))
{
   $username=$_POST['username'];
   $password=$_POST['password'];

   $user=new User();

  if($user->authenticateAdmin($username,$password)){
    session_start();
    $_SESSION['admin'] = $username;
    header( "location: admin/admin_board.php");
    }

   if( $userId=$user->authenticateUser($username,$password)){
     session_start();
     $_SESSION['iduser']=$userId;
     $_SESSION['username'] = $username;
     $_SESSION['password'] = $password;
     header( "location: user/Uboard.php");
  }
  else {
    ?>
    <script type="text/javascript">
      alert("Incorrect credentials ! Please try again");
      window.location.href="logimi.php";
    </script>
    <?php

  }
}

if(isset($_POST['register']))
{
  header( "location: regjistrimi.php");
}

?>
