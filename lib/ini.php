<?php
//pa que muestre los errores
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Tiene que tener el session start para q reciba las variables de sesion
//session_start();

//funcion que recibe como param email y password (es llamada en login.php) y verifica si esta registrado
function auth_user($email,$password){
	
    $user_email = "correo1@fakemail.com";
    $user_password = "123456";

if ($email == $user_email && $password == $user_password){

            $_SESSION['email'] = $email;
            $_SESSION['user'] = $email;
            $_SESSION['password'] = $password;
    
    return true;


    }

}

//Log Out
if(isset($_GET["logout"])){
    session_destroy();
    header("Location:login.php");
    exit();
}

?>