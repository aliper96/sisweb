<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div align="center"> 
      <h2>PREGUNTAS SIN IMAGEN ALMACENADAS EN LA BD</h2><br><br>

      <?php
        require_once('DbConfig.php');
        $conexion = mysqli_connect($server, $user, $pass, $basededatos);
        $sql = "SELECT * FROM preguntas";
        $result = $conexion->query($sql);

        echo "<table border='1'> <tr> <th>Autor</th> <th>Enunciado</th> <th>Respuesta</th> </tr>";

        while($row = $result->fetch_assoc()){
          if($row['foto']==""){
            echo "<tr> <td>".$row['email']."</td> <td>".$row['pregunta']."</td> <td>".$row['correcta']."</td> </tr>";               
          }
        }
        echo "</table>";

        $conexion->close();
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
