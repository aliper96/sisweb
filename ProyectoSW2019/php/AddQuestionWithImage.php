<?php
session_start();
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
?>
<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>

</head>

<body>
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

  

      if (ValidateFieldsPHP($email, $pregunta, $respc, $resp1, $resp2, $resp3, $tema, $complejidad)) {


        if (strlen($_FILES['myfile']['tmp_name']) != 0) {
          $target = addslashes(file_get_contents($_FILES['myfile']['tmp_name']));

          move_uploaded_file($target, $_FILES['myfile']['name']);
          
          $info = getimagesize($_FILES['myfile']['tmp_name']);
          if ($info === FALSE) {
            return false ;
            echo "No es una Imagen";
             die("");

          }

          insert_in_xml($email, $pregunta, $respc, $resp1, $resp2, $resp3, $tema, $complejidad);


          $target = addslashes(file_get_contents($_FILES['myfile']['tmp_name']));
          move_uploaded_file($target, $_FILES['myfile']['name']);

          $sql = "INSERT INTO preguntas(id, email, pregunta, correcta, incorrecta1, incorrecta2, incorrecta3, tematica, complejidad, foto) 
                VALUES(NULL, '$email', '$pregunta', '$respc', '$resp1', '$resp2', '$resp3', '$tema', '$complejidad','$target')";

          

          if ($conexion->query($sql) === TRUE) {
            
            echo "Operación realizada, la pregunta se ha guardado correctamente en la BD. <br>";
            return true;

          } else {
            echo mysql_errno($sql) . ": " . mysql_error($sql). "\n";
            echo "Error, algo salio mal al insertar los datos en la BD. <br>";
            return false;

          }
        } else {
         
          echo "Error, el servidor dice que hay un error con la imagen. <br>";
         return false;
        }
      } else {
        return false;
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
      function insert_in_xml($email, $ques, $respc, $resp1, $resp2, $resp3, $tema, $complejidad){
        $use_errors = libxml_use_internal_errors(true);
        $xml = simplexml_load_file('../xml/Questions.xml');
       if (false === $xml) {
         return false;
          echo"No se encontro el archivo xml o no tienes permisos para abrirlo";
          die("");

        }
        $pregunta = $xml->addChild('assessmentItem');
        $pregunta->addAttribute('complexity', $complejidad);
        $pregunta->addAttribute('subject', $tema );
        $pregunta->addAttribute('author',$email);
        $itembody = $pregunta->addChild( 'itemBody' );
        $itembody->addChild('p',$ques);
        $correctResponse  = $pregunta->addChild('correctResponse');
        $correctResponse ->addChild('value',$respc);
        $incorrectResponses  = $pregunta->addChild('incorrectResponses');
        $incorrectResponses->addChild('value', $resp1);
        $incorrectResponses->addChild('value', $resp2);
        $incorrectResponses->addChild('value', $resp3);
        $xml->asXML('../xml/Questions.xml');
        //echo'<script>alert("Se añadio la pregunta en el xml")</script>';
        libxml_clear_errors();
        libxml_use_internal_errors($use_errors);


    }

      $conexion->close();
      
      ?>
    </div>

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
ob_end_flush ();
?>

