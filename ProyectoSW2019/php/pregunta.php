<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/pregunta.js"></script>


  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <h3>Introduce tus datos</h3>
      <br>

      <legend align="center">Preguntas</legend>
      <br><br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        Pregunta:*<br><input id="pregunta" name="email" size="75" type="number"><br>


        <br>
        <input type="button" id="pre" name="enviar" value="Enviar">

      </form>
      <br>
      <div id="error"></div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>