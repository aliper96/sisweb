
    <!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
  <script src="../js/jquery-3.4.1.min.js"></script>

</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <?php
      require_once('DbConfig.php');
      $conexion = mysqli_connect($server, $user, $pass, $basededatos);

      $email = $_POST['email'];
      $pregunta = $_POST['website'];
      $respc = $_POST['respc'];
      $resp1 = $_POST['resp1'];
      $resp2 = $_POST['resp2'];
      $resp3 = $_POST['resp3'];
      $tema = $_POST['tema'];
      $complejidad = $_POST['nivel'];
      //$target = addslashes(file_get_contents($_FILES['myfile']['tmp_name']));

      //move_uploaded_file($target, $_FILES['myfile']['name']);

      if (ValidateFieldsPHP($email, $pregunta, $respc, $resp1, $resp2, $resp3, $tema, $complejidad)) {

        if (strlen($_FILES['myfile']['tmp_name']) != 0) {
          $target = addslashes(file_get_contents($_FILES['myfile']['tmp_name']));
          move_uploaded_file($target, $_FILES['myfile']['name']);

          $sql = "INSERT INTO preguntas(id, email, pregunta, correcta, incorrecta1, incorrecta2, incorrecta3, tematica, complejidad, foto) 
                VALUES(NULL, '$email', '$pregunta', '$respc', '$resp1', '$resp2', '$resp3', '$tema', '$complejidad','$target')";

          if ($conexion->query($sql) === TRUE) {
            echo "Operación realizada, la pregunta se ha guardado correctamente en la BD. <br>";
            echo "<p><a href='ShowQuestionsWithImage.php?email=$email'>Pulsa para ver las preguntas</a></p>";
          } else {
            //echo mysql_errno($sql) . ": " . mysql_error($sql). "\n";

            echo "Error, algo salio mal al insertar los datos en la BD. <br>";
            echo "<a href='javascript:window.history.go(-1)'>Vuelve atras para revisar la pregunta</a>";
          }
        } else {
          echo "Error, el servidor dice que hay un error con la imagen. <br>";
          echo "<a href='javascript:window.history.go(-1)'>Vuelve atras para revisar la pregunta</a>";
        }
      } else {
        echo "<a href='javascript:window.history.go(-1)'>Vuelve atras para revisar la pregunta</a>";
      }

      function ValidateFieldsPHP($email, $pregunta, $respc, $resp1, $resp2, $resp3, $tema, $complejidad)
      {

        if (preg_match("/(((^[a-zA-Z]+)([0-9]{3})@ikasle\.ehu\.(eus|es))|((^[a-zA-Z]+)\.?([a-zA-Z]*)@ehu\.(eus|es)))$/", $email) == 0) {
          echo "Error, el servidor dice que el email no es correcto. <br>";
          return false;
        }

        if (preg_match("/.{10,}$/", $pregunta) == 0) {
          echo "Error, el servidor dice que la longitud de la pregunta no es correcta. <br>";
          return false;
        }

        if (strlen($respc) == 0 || strlen($resp1) == 0 || strlen($resp2) == 0 || strlen($resp3) == 0 || strlen($tema) == 0) {
          echo "Error, el servidor dice que hay campos vacios. <br>";
          return false;
        }

        if ($complejidad != (1 || 2 || 3)) {
          echo "Error, el servidor dice que hay un fallo en la complejidad de la pregunta. <br>";
          return false;
        }

        return true;
      }

      $conexion->close();
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>

