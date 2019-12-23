<?php

require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');

$ns="http://localhost";

$server = new soap_server;
$server->configureWSDL('contrasena',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//The function we are going to use 
$server->register('contrasena',array('x'=>'xsd:string','y'=>'xsd:int'),array('z'=>'xsd:string'),$ns);
//implementamos la función
function contrasena ($x,$y){
	$archivo = fopen("../txt/toppasswords.txt", "r") or die("No se puede abrir el archivo");
	$valido = true;
	if($y == 1010){
		while(!feof($archivo)){
			if(strcmp($x, str_replace(array("\r", "\n"), '', fgets($archivo))) == 0) {
				$valido = false;
				break;
            }
            
		}
		fclose($archivo);
		if($valido){

			return "VALIDA";
		}else{
			return "INVALIDA";
		}
	}else{
		return "SIN SERVICIO";
	}
}
//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>
