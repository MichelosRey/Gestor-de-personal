<?php

////Inicia o reanuda una sesión de PHP
session_start();
$url_base = "http://localhost/appDes/";  //para colocar una ruta absoluta y no relativa

//Verificamos que haya una sesion existente. Si no la hay redirigimos al usuario ala pagina de inicio de sesión (login.php)
if (!isset($_SESSION['usuario'])) {
    header("Location:" . $url_base . "login.php");
}
?>



<!doctype html> 
<html lang="en">

<head>
    <title>DES</title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
      
    </header>

    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-center">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $url_base ?>index.php" aria-current="page">Inicio<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>empleados">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>puestos">Puestos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>usuarios">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>logout.php">LogOut</a>
            </li>
        </ul>
    </nav>

    <main class="container">