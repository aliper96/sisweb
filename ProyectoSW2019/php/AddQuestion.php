<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
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
        
        $sql = "INSERT INTO preguntas(id, email, pregunta, correcta, incorrecta1, incorrecta2, incorrecta3, tematica, complejidad) 
        VALUES(NULL, '$email', '$pregunta', '$respc', '$resp1', '$resp2', '$resp3', '$tema', '$complejidad')";

        if($conexion->query($sql) === TRUE){
          echo "Operación realizada, la pregunta se ha guardado correctamente en la BD. <br>";
          echo "<p><a href='ShowQuestions.php'>Pulsa para ver las preguntas</a></p>";
        } else {
          echo "Error, algo salio mal al insertar los datos en la BD. <br>";
          echo "<a href='javascript:window.history.go(-1)'>Vuelve atras para revisar la pregunta</a>";
        }

        $conexion->close();
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
