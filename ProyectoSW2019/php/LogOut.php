<?php
    session_start();
    $email =$_SESSION["email"];
session_destroy ();

echo "<script type='text/javascript'> window.onload=alert('HASTA PRONTO')  ;  </script>";


   
echo "<script type='text/javascript'> window.location.href = 'DecreaseGlobalCounter.php?email=$email'; </script>";

?>



