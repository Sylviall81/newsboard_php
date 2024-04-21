<?php



require('ini.php');
require('db_utils.php');


$referrer = $_SERVER['HTTP_REFERER'];

if (!isset($_POST['id']) || ($_POST['id']) == "" ){
	
	
	$mensaje = "ERROR: No es posible realizar la petición: faltan parametros requeridos <br><a href='$referrer'>VOLVER</a>";
	echo $mensaje;	
	exit;
}

		$titulo =$_POST['titulo'] ;
		$texto = $_POST['texto'];
		$categoria = $_POST['categoria'];
		$fecha = $_POST['fecha'];
		$imagen_url = $_POST['imagen_url'];
		$id = $_POST['id'];


//print_r($_POST);


$q = "UPDATE `noticia` SET `titulo`='$titulo',`texto`='$texto',`categoria`='$categoria',`imagen_url`='$imagen_url' WHERE id ='$id'";

$result = consulta($q);

if (!$result){
	
	$mensaje = "No es posible realizar la petición: faltan parametros <br><a href='$referrer'>VOLVER</a>";
	echo $mensaje;
	exit;

}


header( "location:$referrer");


?>











