<?php

//Este código realiza la conexión a una base de datos MySQL utilizando la extensión PDO 

$servidor = "localhost";  //127.0.0.1
$usuario = "root";
$contraseña = "";
$bd = "app";

//compruebo que la conexion a la BBDD es correcta
//Si se establece conexión, se crea el objeto $conexion, que representa la conexión con la BBDD
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $contraseña);

/* En caso de error, capturamos la excepción y mostramos un mensaje de error */
} catch (Exception $e) {   
    echo $e->getMessage();
}

?>