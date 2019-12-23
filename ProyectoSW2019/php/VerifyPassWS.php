<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
$soapclient = new nusoap_client('https://duckbill-certificat.000webhostapp.com/ProyectoSW2019/php/ClientVerifyPass.php?wsdl',true);
$err = $soapclient->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }
$resultado = $soapclient->call('contrasena', array('x'=>$_GET['cont'],'y'=>$_GET['ticket']));


echo $resultado;
?>