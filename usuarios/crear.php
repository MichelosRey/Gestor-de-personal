<?php include("../bd.php");

if ($_POST) {
    print_r($_POST);
    //recuperamos los datos del metodo POST y validamos con isset
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    //preparamos la introduccion de los datos
    $sql = $conexion->prepare("INSERT INTO tabla_usuarios (id,usuario,password,correo) VALUES(null,:usuario,:password,:correo)");
    //Asignamos valores que tienen uso de :variable
    $sql->bindParam(":usuario", $usuario);
    $sql->bindParam(":password", $password);
    $sql->bindParam(":correo", $correo);
    $sql->execute();
    header("Location:index.php");
}
$conexion = null;
?>

<?php include("../header.php"); ?>
<br />

<div class="card">
    <div class="card-header">Datos del usuario</div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario" required/>

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escribe tu contraseña" required/>

            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Tu correo" required/>

            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>

</div>



<?php include("../footer.php"); ?>