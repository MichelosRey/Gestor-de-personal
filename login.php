<?php

//Inicia o reanuda una sesión de PHP
session_start();

//Comprueba si el formulario se envió utilizando el método POST. De ser así, se ejecuta el código dentro de este bloque
if ($_POST) {
    //Conectamos con el archivo que contiene los detalles de la conexión a la BD
    include("./bd.php");

    //verificamos si hay coincidencias en la base de datos para un nombre de usuario y una contraseña especificos
    $sql = $conexion->prepare("SELECT *,count(*) as n_usuarios FROM `tabla_usuarios` WHERE usuario=:usuario AND password=:password");

    //Recuperamos los valores introduciodos en el formulario
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Asociamos estos valores a la consulta SQL preparada
    $sql->bindParam(":usuario", $usuario);
    $sql->bindParam(":password", $password);

    //Ejecutamos la consulta
    $sql->execute();

    //Recuperamos la primera fila array asociativo y lo almacenamos en $registro
    $registro = $sql->fetch(PDO::FETCH_LAZY);

    //Verificamos si se encuentran usuarios.  Si es así, iniciamos una sesión y se redirige al usuario a index.php. Si no, se prepara un mensaje de erro
    if ($registro["n_usuarios"] > 0) {

        $_SESSION['usuario'] = $registro["usuario"];
        $_SESSION['log'] = true;

        header("Location:index.php");
    } else {
        $aviso = "Usuario o contraseña incorrectos";
    }
    $conexion = null; 
}



?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>

    </header>
    <main class="container">
        <div class="row mt-5">
            <div class="col-sm-4">
                <br>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        
                        <!-- Comprobamos si se creó el aviso y lo mostramos por pantalla -->
                        <?php if (isset($aviso)) { ?> 
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $aviso; ?></strong>
                            </div>
                        <?php } ?>

                        <!-- Formulario para iniciar sesion -->
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Introduzca usuario" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Introduzca contraseña" required />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Acceder
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>


    </main>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>