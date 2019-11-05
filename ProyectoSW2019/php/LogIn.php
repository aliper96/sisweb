<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>

  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
    
      <h3>Introduce tus datos</h3>
      <br>

      <legend align="center">Login</legend>
      <br><br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Email:*<br><input id="input_email" name="email" size="75" type="text"><br>
        Contraseña:*<br><input id="input_password" name="password" size="75" type="password"><br>


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
    echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = 'Layout.php?email=$email'; </script>";
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once('DbConfig.php');
  $conexion = mysqli_connect($server, $user, $pass, $basededatos);
  $sql = "SELECT email,contrasena FROM usuarios where email ='$email' ";
  $result = $conexion->query($sql);
  $row = mysqli_fetch_array($result);
  if ($password == $row['contrasena']) {

    alertredirect("Bienvenido " . $email . "!", $email);
    //header("Location:login.php?email=" . urlencode($email));
    
    // header("Location:registro.php");
    
  } else {
    alert("Parametros incorrectos");
  }

  $conexion->close();
}
?>