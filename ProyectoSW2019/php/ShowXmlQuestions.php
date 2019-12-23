<?php
session_start();

?>
<html>

<head>
<!--<?php include '../html/Head.html' ?>-->
  <style>
    .tabla {
      height: 500px;
      overflow: scroll;
    }
  </style>
</head>

<body>
<!-- <?php include '../php/Menus.php' ?>-->
  <!--<section class="main" id="s1">-->
    <div >
      <h2>PREGUNTAS ALMACENADAS EN EL XML</h2><br><br>

      <?php
    $xml = simplexml_load_file('../xml/Questions.xml');
    if (false === $xml) {
        echo"No se encontro el archivo xml o no tienes permisos para abrirlo";
        echo "<a href='javascript:window.history.go(-1)'>Vuelve atras</a>";
        die("");

      }

    echo "<table border='2'><tr><th>ENUNCIADO</th><th>RESPUESTA CORRECTA</th><th>RESPUESTAS INCORRECTAS</th><th>TEMA</th></tr>";
    foreach ($xml->children() as $assessmentItem) {
        echo "<tr>";
        foreach ($assessmentItem->children() as $group) {
            $att = $assessmentItem->attributes(); 
            if ($group->getName() == 'itemBody') {
                echo "<td>$group->p</td>";
            }
            if ($group->getName() == 'correctResponse') {
                echo "<td>$group->value</td>";
            }
            if ($group->getName() == 'incorrectResponses') {
                echo "<td><ol>";
                foreach ($group->children() as $value) {
                    echo "<li>$value</li>";
                }
                echo "</ol></td>";
            }
        } 
      echo "<td>". $att['subject']."</td>";
      echo "</tr>";
    }
    echo "</table>";
    ?>
    </div>
  <!--</section>-->
  <!-- <?php include '../html/Footer.html' ?>-->
</body>

</html>
<?php

if (isset($_SESSION['email'])) {
  if ($_SESSION['email'] == "") {
    echo '<script type="text/javascript">
        alert("Registrate o entra con tu cuenta");
        window.location.href="Layout.php";
        </script>';
  }
    if ($_SESSION['email'] == "admin@ehu.es") {
    echo '<script type="text/javascript">
        alert("Disponible solo para alumnos");
        window.location.href="Layout.php";
        </script>';
  }
} else {
  echo '<script type="text/javascript">
      alert("Registrate o entra con tu cuenta");
      window.location.href="Layout.php";
      </script>';
}
//ob_end_flush ();
?>
