<?php
 @session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
    
     ob_start();
            // echo "<script > window.location.href = 'HandlingAccounts.php'; </script>";

?>
<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestion.js"></script> -->
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <script type="text/javascript" src="../js/showQuestionsAjax.js"></script>
  <script type="text/javascript" src="../js/addQuestionAjax.js"></script>
  <script type="text/javascript" src="../js/CountQuestionsAjax.js"></script>
  <script type="text/javascript" src="../js/showUsers.js"></script>

  <style>
    .tabla {
      height: 500px;
      overflow: scroll;
    }
  </style>

  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div class="tabla">
      <div style="text-align:center; border-color:black; border-style:solid; width:40%; margin:auto;">
        <p> Mis preguntas / Preguntas totales </p>
        <div id='preg'> </div>
        <br>
        <!--<div id='total'></div>-->
        <p>Usuarios conectados</p>
        <div id='contador'></div>
      </div>
      <br>
      <h3>Propón una pregunta</h3>

      <p><span class="error">* Campo obligatorio</span></p>

      <?php
      $email;
      if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
        echo "<form id='fquestion' method='post' name='fquestion' action='AddQuestionWithImage.php?email=$email' enctype='multipart/form-data'>";
        echo "<br>";
        echo "E-mail: <input id='em' type='text' name='email' size='25' value='$email' readonly>";
      } else {
        echo "<form id='fquestion' method='post' name='fquestion' action='AddQuestionWithImage.php' enctype='multipart/form-data'>";
        echo "<br>";
        echo "E-mail: <input id='em' type='text' name='email' size='25'>";
      }
      ?>
      <span class="error">* </span>
      <br>
      Pregunta: <br><input type="text" id="pre" name="website" size="75">
      <span class="error">*</span>
      <br>
      Respuesta correcta: <br><input type="text" name="respc" size="75">
      <span class="error">*</span>
      <br>
      Respuesta incorrecta 1: <br><input type="text" name="resp1" size="75">
      <span class="error">*</span>
      <br>
      Respuesta incorrecta 2: <br><input type="text" name="resp2" size="75">
      <span class="error">*</span>
      <br>
      Respuesta incorrecta 3: <br><input type="text" name="resp3" size="75">
      <span class="error">*</span>
      <br>
      Temática de la pregunta: <br><input type="text" name="tema" size="75">
      <span class="error">*</span>
      <br>
      Complejidad de la pregunta :
      <select name="nivel" id="nivel">
        <option value="1">Baja</option>
        <option value="2">Media</option>
        <option value="3">Alta</option>
      </select>
      <span class="error">* </span>
      <br><br>
      <input type="file" accept="image/" name='myfile' id="my_file">
      <input type="button" id="boton" onclick="setTimeout('showxml()', 1000)" name="enviar" value="Enviar pregunta">
      <input type="button" id="button" onclick="setTimeout('showxml()', 1000)" name="show" value="Ver preguntas">
      <div id="foto" class="fotoo"><img id="ftt" src="" alt="your image" onerror="this.style.visibility='hidden'" height="140" width="150" /></div>
      <br><br>
      <div id="err"></div>

      <br><br>
      <br><br>
      </form>

      <div style="text-align: center; margin:auto;" id="enviar"></div>

    </div>

  </section>

  <?php include '../html/Footer.html' ?>

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