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





?>