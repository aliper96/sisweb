<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestion.js"></script> -->

  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <h3>Introduce tus datos</h3>
      <br>

      <legend align="center">Login</legend>
      <br><br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Email:*<br><input id="input_email" name="email" size="75" type="text"><br>
        Contraseña:*<br><input id="input_password" name="password" size="75" type="password"><br>
        <a href="ChangePassword.php">Olvidado la contraseña</a>


        <br>
        <input type="submit" name="enviar" value="Enviar">

      </form>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>

<?php
if (isset($_POST['enviar'])) {

  function alert($mensaje)
  {
    echo "<script type='text/javascript'>alert('$mensaje');  window.history.go(-1);</script>";
  }

  function alertredirect($mensaje, $email){
    echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = 'Layout.php'; </script>";
  }

  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = crypt($password,"sw");
 

  require_once('DbConfig.php');
  $conexion = mysqli_connect($server, $user, $pass, $basededatos);
  $usuario ="SELECT contrasena  from usuarios where email ='$email'";
  $miusuario = mysqli_fetch_array($conexion->query($usuario));

  $estado = "SELECT estado FROM usuarios where email ='$email'";
  $miestado = mysqli_fetch_array($conexion->query($estado));
  
  

  //echo strlen('$miusuario[0]');
  
 

  
    
 // $cont= mysqli_num_rows($usuarios); //Se verifica el total de filas devueltas
		
	
     

      

      //echo("<script>alert('$.toJSON($usuario)')</script>");
     // echo("<script>alert('$email')</script>");
      $stripped = str_replace(' ', '', $miusuario[0]);
			if ($stripped == $password) {
				
        $_SESSION['email']=$email;
      //  echo("<script>alert('$email')</script>");
				if($email=="admin@ehu.es"){
					
					echo("<script>window.location = 'HandlingAccounts.php';</script>");
				}else{
       


					if (str_replace(' ', '', $miestado[0]) =="bloqueado"){
            echo("<script>alert('Usuario Bloqueado')</script>");
            session_destroy();
						echo("<script>window.location = 'LogIn.php';</script>");
					}else{
					//	echo("<script>alert('BIENVENIDO AL SISTEMA')</script>");
						echo("<script>window.location = 'IncreaseGlobalCounter.php';</script>");
					}
					
				}
			}else{
        echo("<script>alert('Parametros incorrectos')</script>");

        session_destroy();
        echo("<script>window.location = 'LogIn.php';</script>");

      }
            
		

  $conexion->close();
}
?>