<?php
session_start();
?>
<?php
ob_start();
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
   





ob_end_flush ();
?>
<?php

if (isset($_SESSION['email'])) {
  if ($_SESSION['email'] == "") {
    echo '<script type="text/javascript">
        alert("Registrate o entra con tu cuenta");
        window.location.href="Layout.php";
        </script>';
  }
    if ($_SESSION['email'] == "admin@ehu.es") {
    echo '<script type="text/javascript">
        alert("Disponible solo para alumnos");
        window.location.href="Layout.php";
        </script>';
  }
} else {
  echo '<script type="text/javascript">
      alert("Registrate o entra con tu cuenta");
      window.location.href="Layout.php";
      </script>';
}
ob_end_flush ();
?>