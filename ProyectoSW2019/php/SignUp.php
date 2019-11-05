<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>

  <section class="main" id="s1">
    <div>
      <h3>Introduce tus datos</h3>
      <p><span class="error">* Campo obligatorio</span></p>
      <br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        ¿Eres alumno o profesor ? :
        <select name="tipo" id="nivel">

          <option value="1">Alumno</option>
          <br>
          <option value="2">Profesor</option>
        </select><br><br>
        Email*: <br><input id="email" name="email" size="75" type="text">
        <br><br>
        Nombre y Apellidos*: <br><input id="nombre" name="nombre" size="75" type="text">
        <br><br>
        Contraseña*: <br><input id="password" name="password" size="75" type="password">
        <br><br>
        Repetir contraseña*: <br><input id="input_passwordr" name="passwordr" size="75" type="password">
        <br><br>
        <input type="file" name='myfiler' id="my_file"> <input type="submit" name="submit" value="Registrarse">
        <div id="foto" class="fotoo"><img id="ftt" src="" alt="your image" onerror="this.style.visibility='hidden'" height="140" width="150" /></div>

      </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
  <?php
  if (isset($_POST['submit'])) { //check if form was submitted

    function alert($mensaje)
    {
      echo "<script type='text/javascript'>alert('$mensaje');  window.history.go(-1);</script>";
    }

    function alertredirect($mensaje){
      echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = 'LogIn.php'; </script>";
    }

    function ValidateRegisterPHP($email, $password, $passwordr, $nombre, $tipo)
    {

      if (preg_match("/(((^[a-zA-Z]+)([0-9]{3})@ikasle\.ehu\.(eus|es))|((^[a-zA-Z]+)\.?([a-zA-Z]*)@ehu\.(eus|es)))$/", $email) == 0) {
        alert("Error, el servidor dice que el email no es correcto.");
        return false;
      }

      if (preg_match("/.{6,}$/", $password) == 0) {
        alert("Error, el servidor dice que las contraseñas son cortas (min. 6 caracteres).");
        return false;
      }

      if ($password != $passwordr) {
        alert("Error, el servidor dice que las contraseñas no coinciden.");
        return false;
      }

      if (preg_match("/([a-zA-Z0-9]*\s?){2,}$/", $nombre) == 0) {
        alert("Error, el servidor dice que tiene que haber al menos 2 palabras.");
        return false;
      }

      if ($tipo != (1 || 2)) {
        alert("Error, el servidor dice que hay un fallo en el tipo de usuario.");
        return false;
      }

      return true;
    }

    require_once('DbConfig.php');

    $conexion = mysqli_connect($server, $user, $pass, $basededatos);
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $passwordr = $_POST['passwordr'];
    $tipo = $_POST['tipo'];

    /*if (isset($_FILES["myfiler"]) && !empty($_FILES["myfiler"]["name"])) {
      $target = addslashes(file_get_contents($_FILES['myfiler']['tmp_name']));
      move_uploaded_file($target, $_FILES['myfiler']['name']);
    }*/
    /*
    print_r($email);
    echo '<br/>';

    print_r($nombre);
    echo '<br/>';

    print_r($password);
    echo '<br/>';

    print_r($tipo);*/

    if (ValidateRegisterPHP($email, $password, $passwordr, $nombre, $tipo)) {

      
      if (isset($_FILES["myfiler"]) && !empty($_FILES["myfiler"]["name"])) {
        $target = addslashes(file_get_contents($_FILES['myfiler']['tmp_name']));
        move_uploaded_file($target, $_FILES['myfiler']['name']);

        $sql = "INSERT INTO usuarios ( email, contrasena, nya, PoA, foto) 
        VALUES( '$email', '$password','$nombre', '$tipo', '$target')";

        if ($conexion->query($sql) === TRUE) {
          alertredirect("Registro completado exitosamente.");
        } else {
          alert("Error, algo salio mal al insertar los datos en la BD.");
        }
      } else {
        alert("Error, el servidor dice que hay un error con la imagen.");
      }
    } else {
      alert("Error, no cumples los parametros para registrarte.");
    }

    $conexion->close();
  }
  ?>
</body>

</html>