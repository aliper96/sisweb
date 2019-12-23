
<div id='page-wrap'>


  <script src="../js/jquery-3.4.1.min.js"></script>


  <header class='main' id='h1'>
    <?php
 
    /*function checkQuestions() {
      
      $preguntass = "SELECT COUNT (*) FROM preguntas" ;
      $mispreguntass = "SELECT COUNT (*) FROM preguntas where email ='$email' ";
      $preguntas = $conexion->query($preguntass);
      $mispreguntas = $conexion->query($mispreguntass);


  }*/
    if (isset($_SESSION["email"])) {
      $email = $_SESSION["email"];
      echo "<span class='right'><a href='LogOut.php?email=$email'>Logout</a></span>";
      echo " ";
      echo '¡Hola ' . htmlspecialchars($_SESSION["email"]) . '!';
      require_once('DbConfig.php');
      $conexion = mysqli_connect($server, $user, $pass, $basededatos);


      $sql = "SELECT email,foto FROM usuarios where email ='$email' ";
      $result = $conexion->query($sql);
      $row = mysqli_fetch_array($result);

      if ($row['foto'] != "") {
        if ($email!="admin@ehu.es")
           
                    //print_r($linea['foto']);
                    echo " <td> <img height='100px'  src='".$row['foto'] ."'/></td>";
                  
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
    if (isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      
        if($email=="admin@ehu.es"){
          echo "<span><a href='HandlingAccounts.php'>Gestionar Cuentas</a></span> ";
        }	
      echo "<span><a href='Layout.php'>Inicio</a></span>";
      echo "<span><a href='https://duckbill-certificat.000webhostapp.com/ProyectoSW2019/php/Credits.php'>Creditos</a></span>";
      //echo "<span><a href='QuestionFormWithImage.php?email=$email'> Insertar Pregunta</a></span>";
      //echo "<span><a href='ShowQuestionsWithImage.php?email=$email'> Ver Preguntas</a></span>";
      //echo "<span><a href='ShowXmlQuestions.php?email=$email'> Ver Preguntas Xml</a></span>";
      //echo "<span><a href='../xml/Questions.xml'> Ver Preguntas Xml (XSL)</a></span>";
      //echo "<span><a href='../html/GetUserInfo.html'> Get User Info</a></span>";
        if($email!="admin@ehu.es"){
      echo "<span><a href='HandlingQuizesAjax.php'>Gestionar Preguntas</a></span> ";
      
      echo "<span><a href='pregunta.php'>Preguntas Cliente</a></span> ";
}
    //  echo " Mis preguntas ";
    //  echo " <div id='preg' > </div>";
     // echo "Preguntas totales ";
      //echo "<div  id='total'></div>";
      //echo "Usuarios conectados";
      //echo "<div  id='contador'></div>";
    } else {
      echo "<span><a href='Layout.php'>Inicio</a></span>";
      echo "<span><a href='https://duckbill-certificat.000webhostapp.com/ProyectoSW2019/php/Credits.php'>Creditos</a></span>";
    }
  
    ?>

  </nav>