<?php
session_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/verPass.js"></script>

  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestion.js"></script> -->

  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <h3>Introduce tus datos</h3>
      <br>

      <legend align="center">Restablecer</legend>
      <br><br>
      <form action="<?php echo htmlspecialchars($actual_link); ?>" method="post" >
        
        Contraseña:*<br><input id="passwordd" name="password" size="75" type="password"><br>
        Repite la contraseña:*<br><input id="passworddr" name="passwordr" size="75" type="password"><br>
        <div id="pass"></div>



        <br>
        <input type="submit" id="Boton" name="enviar" value="Enviar">

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
    echo "<script type='text/javascript'>alert('$mensaje');</script>";

  }

  


  $password = $_POST['password'];
  $passwordr = $_POST['passwordr'];
  $password = crypt($password,"sw");
 

  require_once('DbConfig.php');
  $codigo = (string)$_GET['codigo'];
  $email =  (string)($_GET['email']);



  $conexion = mysqli_connect($server, $user, $pass, $basededatos);
  $usuario ="SELECT codigo  from reset where email ='$email'";
  $miusuario = mysqli_fetch_array($conexion->query($usuario));

  if ($miusuario[0] == $codigo ){
  $sql= "UPDATE usuarios SET contrasena='$password' WHERE email='$email'";
  if(mysqli_query($conexion, $sql)===TRUE){
      $sqll= "DELETE FROM reset WHERE email='$email'";
      $conexion->query($sqll);
      
        echo "<script type='text/javascript'>alert('Operacion realizada'); window.location.href = 'LogIn.php'; </script>";
  }

    }else{
        echo "<script type='text/javascript'>alert('Enlace caducado, intentalo de nuevo'); window.location.href = 'ChangePassword.php'; </script>";


    }
  $conexion->close();

  }

?>