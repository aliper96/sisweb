<div id='page-wrap'>
  <header class='main' id='h1'>
    <?php
    $email;
    if (isset($_GET["email"])) {
      $email = $_GET["email"];
      echo "<span class='right'><a href='LogOut.php'>Logout</a></span>";
      echo " ";
      echo '¡Hola ' . htmlspecialchars($_GET["email"]) . '!';
      require_once('DbConfig.php');
      $conexion = mysqli_connect($server, $user, $pass, $basededatos);
      $sql = "SELECT email,foto FROM usuarios where email ='$email' ";
      $result = $conexion->query($sql);
      $row = mysqli_fetch_array($result);

      if ($row['foto'] != "") {
        echo "<div><img height='150' width='150' with  src='data:image/;base64," . base64_encode($row['foto']) . "'/></div>";
      }
      
    } else {
      echo "<span class='right'><a href='SignUp.php'>Registro</a></span>";
      echo " ";
      echo "<span class='right'><a href='LogIn.php'>Login</a></span>";
      echo " ";
      echo "Anónimo";
      echo " ";
      echo "<img height='100px'  src='../images/anonimo.png'/>";
    }
    ?>

  </header>
  <nav class='main' id='n1' role='navigation'>
    <?php
    if (isset($_GET['email'])) {
      echo "<span><a href='Layout.php?email=$email'>Inicio</a></span>";
      echo "<span><a href='Credits.php?email=$email'>Creditos</a></span>";
      echo "<span><a href='QuestionFormWithImage.php?email=$email'> Insertar Pregunta</a></span>";
      echo "<span><a href='ShowQuestionsWithImage.php?email=$email'> Ver Preguntas</a></span>";
    } else {
      echo "<span><a href='Layout.php'>Inicio</a></span>";
      echo "<span><a href='Credits.php'>Creditos</a></span>";
    }
    ?>

  </nav>