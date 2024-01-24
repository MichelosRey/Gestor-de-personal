<?php
//Conectamos con el archivo que contiene los detalles de la conexión a la BD
include("../bd.php");

//Verificamos si el formulario se ha enviado utilizando el método POST
if ($_POST) {
    //Recuperamos y almacenamos los valores del formulario
    $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
    $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
    $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
    $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

    //Preparamos la consulta para insertar un nuevo registro en la tabla tabla_empleados 
    $sql=$conexion->prepare("INSERT INTO tabla_empleados(id,nombre,primerapellido,segundoapellido,idpuesto,fechadeingreso) VALUES (null, :nombre,:primerapellido,:segundoapellido,:idpuesto,:fechadeingreso)");
    
    //Asociamos los valores del formulario a la consulta SQL
    $sql->bindParam(":nombre",$nombre);
    $sql->bindParam(":primerapellido",$primerapellido);
    $sql->bindParam(":segundoapellido",$segundoapellido);
    $sql->bindParam(":idpuesto",$idpuesto);
    $sql->bindParam(":fechadeingreso",$fechadeingreso);

    //Ejecutamos la consulta y redirigimos al usuario a index.php
    $sql->execute();
    header("Location:index.php");
}

//Preparamos otra consulta para obtener la lista de puestos y almacenarla en $lista_tabla_puestos
$sql = $conexion->prepare("SELECT * FROM `tabla_puestos`");
$sql->execute();
$lista_tabla_puestos = $sql->fetchAll(PDO::FETCH_ASSOC);

$conexion = null;
?>
<!-- Incluimos el archivo header.php-->
<?php include("../header.php"); ?>

<br />

<div class="card">
    <div class="card-header">Datos del empleado</div>
    <div class="card-body">

        <!-- Formulario que permite al usuario ingresar datos del nuevo empleado y enviarlo a través de POST -->
        <form action="" method="post">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Tú nombre" required>
            </div>
            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer Apellido:</label>
                <input type="text" class="form-control" name="primerapellido" placeholder="Primer apellido" required>
            </div>
            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
                <input type="text" class="form-control" name="segundoapellido" placeholder="Segundo apellido">
            </div>
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Seleccione puesto:</label>
                <select class="form-select form-select-sm" id="idpuesto" name="idpuesto">
                    <!--  -->
                    <?php foreach ($lista_tabla_puestos as $registro) { ?>
                        <option value="<?php echo $registro['id'] ?>"><?php echo $registro['nombredelpuesto'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
                <input type="date" class="form-control" name="fechadeingreso" required>
            </div>
            <!-- Enviamos la informacion del formulario -->
            <button type="submit" class="btn btn-primary">Añadir</button>
            <a class="btn btn-danger" href="index.php">Cenelar</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<br />
<!-- Incluimos el archivo footer.php-->
<?php include("../footer.php"); ?>