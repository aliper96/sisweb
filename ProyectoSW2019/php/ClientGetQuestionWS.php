<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');


$ns="http://localhost";

$server = new soap_server;
$server->configureWSDL('ObtenerPregunta',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//The function we are going to use 
$server->register('ObtenerPregunta',array('x'=>'xsd:string'),array('z'=>'xsd:string','a'=>'xsd:string','u'=>'xsd:string'),$ns);
//implementamos la función
function ObtenerPregunta ($x){
    require_once('DbConfig.php');

    $conexion = mysqli_connect($server, $user, $pass, $basededatos);
    $sql = "SELECT email,pregunta,correcta FROM preguntas where id ='$x' ";
    $result = $conexion->query($sql);
    $row = mysqli_fetch_array($result);
		if($row["email"]!=""){

			return (array($row['email'],$row['pregunta'],$row['correcta']));
		}else{
			return (array("","",""));
		}
	
}
//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>