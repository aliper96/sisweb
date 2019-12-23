<?php
session_start();
?>
<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
require_once('DbConfig.php');

$soapclient = new nusoap_client('https://duckbill-certificat.000webhostapp.com/ProyectoSW2019/php/ClientGetQuestionWS.php?wsdl',true);
$err = $soapclient->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }
$resultado = $soapclient->call('ObtenerPregunta', array('x'=>$_GET['pregunta']));

print_r($resultado["z"]);print_r(",");print_r($resultado["a"]);print_r(","); print_r($resultado["u"]);

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
