<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);




//conexion
function conexion(){
	$host = "localhost";
	$user = "sylvia";
	$psswd = "45960967Kk*";
	$database = "db_noticias";

	// Conexión
	$conexion = mysqli_connect($host, $user, $psswd) or die("Connection failed: " . mysqli_connect_error());
	//echo "Conectado al servidor<br>"; Para probar si se conecta

	// Seleccionamos la base de datos esta es especifica para la base de datos 
	//pero se puede hacer todo en un solo ṕaso el return obvio seria $conn y siempre hay q usar ~conn
	//$conn = mysqli_connect($host/$server, $username, $password, $dbname);
	
	
	mysqli_select_db($conexion, $database) or die("Connection failed: " . mysqli_connect_error());
	

return $conexion;
	
}

//consulta

function consulta($q){
	
	$conexion = conexion();
	
	$result = mysqli_query($conexion,$q);
	mysqli_close($conexion);
	
	return $result;
}


//contar filas

function contar_filas($q){
	
	$result = consulta($q);

	$nFilas = mysqli_num_rows($result);
	
	return $nFilas;

}


//escape

function escape($q){
	
	$conexion = conexion();
	return mysqli_real_escape_string($conexion,$q);
	}



$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
$url_imagen = "https://res.cloudinary.com/dsesprxhl/image/upload/v1713624281/Web%20Grafic%20Tools/icons/news-placeholder_wmubzt.jpg";
?>