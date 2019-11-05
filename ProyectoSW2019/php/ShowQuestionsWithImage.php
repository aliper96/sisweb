<!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
  <style>
    .tabla {
      height: 500px;
      overflow: scroll;
    }
  </style>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div align="center" class="tabla">
      <h2>PREGUNTAS CON IMAGEN ALMACENADAS EN LA BD</h2><br><br>

      <?php
      require_once('DbConfig.php');
      $conexion = mysqli_connect($server, $user, $pass, $basededatos);
      $sql = "SELECT * FROM preguntas";
      $result = $conexion->query($sql);

      echo "<table border='1'> <tr> <th>Autor</th> <th>Enunciado</th> <th>Respuesta</th> <th>foto</th> </tr>";

      while ($row = mysqli_fetch_array($result)) {
        if ($row['foto'] != "") {
          echo "<tr> <td>" . $row['email'] . "</td> <td>" . $row['pregunta'] . "</td> <td>" . $row['correcta'] .
            " </td> <td> <img height='100px'  src='data:image/;base64," . base64_encode($row['foto']) . "'/></td> </tr>";
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