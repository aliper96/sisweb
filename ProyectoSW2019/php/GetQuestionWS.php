<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
require_once('DbConfig.php');

$soapclient = new nusoap_client('http://localhost:802/ProyectoSW2019/php/ClientGetQuestionWS.php?wsdl',true);
$err = $soapclient->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }
$resultado = $soapclient->call('ObtenerPregunta', array('x'=>$_GET['pregunta']));

print_r($resultado["z"]);print_r(" ");print_r($resultado["a"]);print_r(" "); print_r($resultado["u"]);

?>
