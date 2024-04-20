<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('./lib/db_utils.php');

//enlace de donde viene de donde fue redireccionado hasta aqui
$referrer = $_SERVER['HTTP_REFERER'];

if (!isset($_POST['id']) || ($_POST['id']) == "" ){
	
	$mensaje = "ERROR: No es posible realizar la petición: faltan parametros requeridos <br><a href='$referrer'>VOLVER</a>";
	echo $mensaje;	
	exit;
}

$id = $_POST['id'];
 
$q = "DELETE FROM noticia WHERE `noticia`.`id` = $id";

$result = consulta($q);

	
if (!$result){
	
	$mensaje = "No es posible realizar la petición: faltan parametros <br><a href='$referrer'>VOLVER</a>";
	echo $mensaje;
	exit;

}


header( "location:$referrer");
exit;