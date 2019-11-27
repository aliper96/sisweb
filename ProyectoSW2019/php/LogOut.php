<?php
    session_start();
    $email =$_SESSION["email"];


echo "<script type='text/javascript'> window.onload=alert('HASTA PRONTO')  ;  </script>";

   
echo "<script type='text/javascript'> window.location.href = 'DecreaseGlobalCounter.php?email=$email'; </script>";

session_destroy ();
    
?>



