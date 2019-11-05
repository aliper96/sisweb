<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <h3>Propón una pregunta</h3>
      <p><span class="error">* Campo obligatorio</span></p>

      <form id="fquestion" name="fquestion" action="AddQuestion.php" method="POST">
        <br>
        E-mail: <input type="email" pattern="(((^[a-zA-Z]+)([0-9]{3})@ikasle\.ehu\.(eus|es))|((^[a-zA-Z]+)\.?([a-zA-Z]*)@ehu\.(eus|es)))" name="email" size="25" required>
        <span class="error">* </span>
        <br><br>
        Pregunta: <br><input type="text" pattern=".{10,}" name="website" size="75" required>
        <span class="error">*</span>
        <br><br>
        Respuesta correcta: <br><input type="text" name="respc" size="75" required>
        <span class="error">*</span>  
        <br><br>
        
        Respuesta incorrecta 1: <br><input type="text" name="resp1" size="75" required>
        <span class="error">*</span>
        <br><br>
        Respuesta incorrecta 2: <br><input type="text" name="resp2" size="75" required>
        <span class="error">*</span>
        <br><br>
        Respuesta incorrecta 3: <br><input type="text" name="resp3" size="75" required>
        <span class="error">*</span>
        <br><br>
        Temática de la pregunta: <br><input type="text" name="tema" size="75" required>
        <span class="error">*</span>
        <br><br>       
        Complejidad de la pregunta :
        <select name= "nivel" id= "nivel" required>
          <option value="1">Baja</option>
          <option value="2">Media</option>
          <option value="3">Alta</option>
        </select>  
        <span class="error">* </span>
        <br><br>  
        <input type="submit" name="submit" value="Submit">  
      </form>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
