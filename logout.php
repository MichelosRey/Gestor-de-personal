<?php
//Iniciamos o reanudamos una sesión de PHP usando las variables de sesión para almacenar información mientras el usuario utiliza la web
session_start();

//eliminamos todas las variables de sesión y finalizamos la sesión actual
session_destroy();
//Redirigimos al navegador a otra pagina. En este caso a 'login.php'
header("Location:login.php");
?>