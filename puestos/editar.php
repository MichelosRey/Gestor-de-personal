<?php

//Conectamos con el archivo que contiene los detalles de la conexión a la BD
include("../bd.php");

//Verificamos si se ha proporcionado el parámetro txtID a través de la URL
if (isset($_GET['txtID'])) {
    // Obtenemos el ID del empleado a editar
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    $sql = $conexion->prepare("SELECT * FROM tabla_puestos WHERE id=:id");
    $sql->bindParam(":id", $txtID);
    $sql->execute();
    $registro = $sql->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto = $registro["nombredelpuesto"];
}
if ($_POST) {
    print_r($_POST);
    //recuperamos los datos del metodo POST y validamos con isset
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "");
    //preparamos la consulta para la introduccion de los datos
    $sql = $conexion->prepare("UPDATE tabla_puestos SET nombredelpuesto=:nombredelpuesto WHERE id=:id");
    //asignamos los valores del formulario a traves de POST
    $sql->bindParam(":nombredelpuesto", $nombredelpuesto);
    $sql->bindParam(":id", $txtID);
    $sql->execute();
    header("Location:index.php");
}

$conexion = null;
?>




<?php include("../header.php"); ?>
<br />

<div class="card">
    <div class="card-header">Puestos</div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />
            </div>


            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre Puesto:</label>
                <!-- Con el atributo value="php echo $nombre muestro los datos de las variables  -->
                <input type="text" value="<?php echo $nombredelpuesto ?>" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto" required />

            </div>
            <!-- Enviamos los datos para el UPDATE de la BD -->
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>

</div>



<?php include("../footer.php"); ?>