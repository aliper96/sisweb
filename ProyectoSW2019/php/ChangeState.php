<?php

require_once('DbConfig.php');
 if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");


$email=$_GET['email'];
$estado=$_GET['estado'];


if($estado=="bloqueado"){
	$sql= "UPDATE usuarios SET estado='bloqueado' WHERE email='$email'";
	if(mysqli_query($con, $sql)===TRUE){
        echo "<script>alert('Operacion realizada');</script>";

    }
    mysqli_close($con);
    header('Location: HandlingAccounts.php'); 
    exit;

}


if($estado=="activado") {
	$sql= "UPDATE usuarios SET estado='activado' WHERE email='$email'";
    if(mysqli_query($con, $sql)===TRUE){
        echo "<script>alert('Operacion realizada');</script>";

    }
    mysqli_close($con);
    header('Location: HandlingAccounts.php'); 
    exit;

}
   






?>