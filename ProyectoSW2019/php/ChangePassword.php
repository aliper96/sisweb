<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
!extension_loaded('openssl')?"Not Available":"Available";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';
require '../vendor/autoload.php';


$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';


// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "aligsw69@gmail.com";
//Password to use for SMTP authentication
$mail->Password = 'Password';
//Set who the message is to be sent from
$mail->setFrom('aligsw69@gmail.com', 'Admin');
//Set an alternative reply-to address
//Set who the message is to be sent to
$mail->Subject = 'Restablecer la contraseña';

?>
<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestion.js"></script> -->

  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <h3>Introduce tu correo</h3>
      <br>

      <legend align="center">Restablece tu contraseña</legend>
      <br><br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Email:*<br><input id="input_email" name="email" size="75" type="text"><br>
        


        <br>
        <input type="submit" name="enviar" value="Enviar">

      </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>

<?php
if (isset($_POST['enviar'])) {

  function alert($mensaje)
  {
    echo "<script type='text/javascript'>alert('$mensaje');  window.history.go(-1);</script>";
  }

  function alertredirect($mensaje, $email){
    echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = 'Layout.php'; </script>";
  }

  $email = $_POST['email'];

 $codigo = md5(random_int(99, 9999));

  require_once('DbConfig.php');
  $conexion = mysqli_connect($server, $user, $pass, $basededatos);
  $usuario ="SELECT email  from usuarios where email ='$email'";
  $sqll= "DELETE FROM reset WHERE email='$email'";
  $conexion->query($sqll); 
  $miusuario = mysqli_fetch_array($conexion->query($usuario));
        $sql = "INSERT INTO reset ( email, codigo) 
        VALUES( '$email', '$codigo')";

        $conexion->query($sql) ;

 
 
  
  if(!mysqli_num_rows($conexion->query($usuario))) {
    echo "<script type='text/javascript'>alert('Email no registrado o incorrecto');  </script>";
}else{

$mail->addAddress($email);
//Set the subject line

$mail->Body .="<h1 style='color:#3498db;'>Restablecer!</h1>";
$mail->Body .= "<p>Mensaje personalizado</p>";
$mail->Body .= '<a href="https://duckbill-certificat.000webhostapp.com/ProyectoSW2019/php/Restablecer.php?codigo='.$codigo."&email=".$email.'">Restablecer la contraseña</a>';
$mail->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
$mail->IsHTML(true);

if(!$mail->send()) {
 alert( 'Message was not sent.');
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {

      echo "<script type='text/javascript'>alert('Message has been sent.'); window.location.href = 'LogIn.php'; </script>";

}
      

      


	
            
		
}
  $conexion->close();
}
?>