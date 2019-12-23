<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.
$soapclient = new nusoap_client( 'http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl',true);
$err = $soapclient->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }

$result = $soapclient->call('comprobar', array('x'=>$_GET['email']));
print_r($result);


return $result;

?>
