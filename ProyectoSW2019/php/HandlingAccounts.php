<?php
session_start();
require_once('DbConfig.php');
if(!($con = mysqli_connect($server, $user, $pass, $basededatos)))		
			die("Error: No se pudo conectar");	
		
	if (isset($_SESSION['email'])){
		$mail = $_SESSION['email'];
		if($mail!="admin@ehu.es"){
			echo("<script>window.location = 'Layout.php';</script>");
		}	
	}else{
		 echo("<script>window.location = 'LogIn.php';</script>");
	}
	
	include '../html/Head.html';
    include '../php/Menus.php';	
	$consulta = "SELECT * FROM usuarios";
	
	$resultado = mysqli_query($con, $consulta); 
	if(!$resultado) 
		die("Error: no se pudo realizar la consulta");
	
	echo '<table border="1">';
	echo '<tr bgcolor="#848484">';
	echo '<th>Email</th>';
	echo '<th>Nombre</th>';
	echo '<th>Password</th>';
	echo '<th>Activo /Bloqueado </th>';
    echo '<th>Eliminar</th>';
    echo '<th>Foto</th>';

	echo '</tr>';
	while($linea = mysqli_fetch_assoc($resultado)) 
	{ 
		if($linea['email']!="admin@ehu.es"){
		
				if($linea['estado'] == "activado"){
					$activo="bloqueado";
				}else{
					$activo="activado";
				}
				echo '<tr bgcolor="#D8D8D8">'; 
                echo '<td>' . $linea['email'] . '</td><td>' . $linea['nya'] . '</td><td>' . $linea['contrasena'] . 
                '</td><td> <button type="submit" id="Boton" name="submit" onclick=funcion("ChangeState.php?email='.$linea['email'].'&estado='.$activo.'")>Cambiar a '.$activo.' </button>  </td>   <td> <button type="submit" id="Boton2" name="Boton2" onclick=funcion_eliminar("'.$linea['email'].'","RemoveUser.php?email='.$linea['email'].'") >Eliminar cuenta</button>  </td>';
                if ($linea['foto'] != "") {
                    //print_r($linea['foto']);
                    echo " <td> <img height='100px'  src='".$linea['foto'] ."'/></td>";
                  }
                echo '</tr>'; 
		}
		
	}
	echo '</table>';
	
	
	?>
	
	<script>
	function funcion(link){
		location.href = link;
	}
	function funcion_eliminar(email, link){
		var result = confirm("¿Quieres eliminar la cuenta: " + email + "?");
	if (result) {
    	location.href = link;
	}
		
	}
	
	
	</script>
	
	<?php
include '../html/Footer.html' ;

if (isset($_SESSION['email'])) {
  if ($_SESSION['email'] == "") {
    echo '<script type="text/javascript">
        alert("Registrate o entra con tu cuenta");
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