<?php
//Conectamos con el archivo que contiene los detalles de la conexión a la BD
include("../bd.php");
//Verificamos si se ha proporcionado el parámetro txtID a través de la URL
if (isset($_GET['txtID'])) {
    // Obtenemos el ID del empleado a editar
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    // Consultamos la base de datos para obtener los datos del usuario con el ID especifico
    $sql = $conexion->prepare("SELECT * FROM tabla_usuarios WHERE id=:id");
    //Asociamos el valor de $txtID al marcador de posición :id 
    $sql->bindParam(":id", $txtID);
    //Ejecutamos la consulta y Recuperamos la primera fila array asociativo y lo almacenamos en $registro
    $sql->execute();
    $registro = $sql->fetch(PDO::FETCH_LAZY);
    //Asignamos los valores obtenidos a variables para usarlos en el formulario
    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}
//Comprobamos si ha habido envio de datos a traves de POST
if ($_POST) {
    //validamos con isset y recuperamos los datos del metodo POST
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";
    $correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";
    //preparamos la introduccion de los datos
    $sql = $conexion->prepare("UPDATE tabla_usuarios SET usuario=:usuario, password=:password,correo=:correo WHERE id=:id");
    //Asociamos los valores de las variables a los marcadores de posición de la consulta preparada
    $sql->bindParam(":usuario", $usuario);
    $sql->bindParam(":password", $password);
    $sql->bindParam(":correo", $correo);
    $sql->bindParam(":id", $txtID);
    //Ejecutamos la consulta y redirigimos a la pagina index.php
    $sql->execute();
    header("Location:index.php");
}
$conexion = null;
?>

<?php include("../header.php"); ?>
<br />

<br />

<div class="card">
    <div class="card-header">Datos del usuario</div>
    <div class="card-body">

        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <!-- Con el atributo value="php echo $nombre muestro los datos de las variables  -->
                <input type="text" value="<?php echo $txtID ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" value="<?php echo $usuario ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario" />

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" value="<?php echo $password ?>" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escribe tu contraseña" />

            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" value="<?php echo $correo ?>" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Tu correo" />

            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>

</div>



<?php include("../footer.php"); ?>