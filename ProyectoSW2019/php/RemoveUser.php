<?php
 require_once('DbConfig.php');
  if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");
$email=(string)$_GET['email'];
	$sql= "DELETE FROM usuarios WHERE email='$email'";
	if(mysqli_query($con, $sql)===TRUE){
        echo "<script>alert('Operacion realizada');</script>";
    }
    mysqli_close($con);
    header('Location: HandlingAccounts.php'); 
    exit;
   
?>