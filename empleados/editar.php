<?php
//Conectamos con el archivo que contiene los detalles de la conexión a la BD
include("../bd.php");
//Verificamos si se ha proporcionado el parámetro txtID a través de la URL
if (isset($_GET['txtID'])) {
    //// Obtenemos el ID del empleado a editar
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    // Consultamos la base de datos para obtener los datos del empleado con el ID especifico
    $sql = $conexion->prepare("SELECT * FROM tabla_empleados WHERE id=:id");
    //Asociamos el valor de $txtID al marcador de posición :id 
    $sql->bindParam(":id", $txtID);
    //Ejecutamos la consulta
    $sql->execute();
    //Recuperamos la primera fila array asociativo y lo almacenamos en $registro
    $registro = $sql->fetch(PDO::FETCH_LAZY);

    //Asignamos los valores obtenidos a variables para usarlos en el formulario
    $nombre = $registro["nombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];
    $idpuesto = $registro["idpuesto"];
    $fechadeingreso = $registro["fechadeingreso"];
    //Asignamos estos valores a la consulta SQL preparada
    $sql->bindParam(":nombre", $nombre);
    $sql->bindParam(":primerapellido", $primerapellido);
    $sql->bindParam(":segundoapellido", $segundoapellido);
    $sql->bindParam(":idpuesto", $idpuesto);
    $sql->bindParam(":fechadeingreso", $fechadeingreso);
    //Obtenemos la lista de puestos desde la base de datos
    $sql = $conexion->prepare("SELECT * FROM `tabla_puestos`");
    $sql->execute();
    $lista_tabla_puestos = $sql->fetchAll(PDO::FETCH_ASSOC);
}

//Comprobamos si ha habido envio de datos a traves de POST
if ($_POST) {
    //Obtenemos los datos del formulario enviado por el método POST y los asignamos a variables
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
    $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");
    $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");
    //Preparamos la consulta para actualizar los datos de la tabla empleados
    $sql = $conexion->prepare("UPDATE tabla_empleados SET nombre=:nombre, primerapellido=:primerapellido, segundoapellido=:segundoapellido, idpuesto=:idpuesto, fechadeingreso=:fechadeingreso WHERE id=:id");


    //Asociamos los valores de las variables a los marcadores de posición de la consulta preparada
    $sql->bindParam(":nombre", $nombre);
    $sql->bindParam(":primerapellido", $primerapellido);
    $sql->bindParam(":segundoapellido", $segundoapellido);
    $sql->bindParam(":idpuesto", $idpuesto);
    $sql->bindParam(":fechadeingreso", $fechadeingreso);
    $sql->bindParam(":id", $txtID);
    //Ejecutamos la consulta y redirigimos a la pagina index.php
    $sql->execute();
    header("Location:index.php");
}
$conexion = null;

?>


<?php include("../header.php"); ?>

<br />

<div class="card">
    <div class="card-header">Datos del empleado</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <!-- Con el atributo value="php echo $nombre muestro los datos de las variables  -->
                <input type="text" value="<?php echo $nombre ?>" class="form-control" name="nombre" placeholder="Tú nombre" required>
            </div>
            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer Apellido:</label>
                <input type="text" value="<?php echo $primerapellido ?>" class="form-control" name="primerapellido" placeholder="Primer apellido" required>
            </div>
            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
                <input type="text" value="<?php echo $segundoapellido ?>" class="form-control" name="segundoapellido" placeholder="Segundo apellido">
            </div>
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Seleccione puesto:</label>

                <select class="form-select form-select-sm" id="idpuesto" name="idpuesto">
                    <!-- Iteramos sobre cada elemento del array de la variable $lista_tabla_puestos y lo almacenamos en $registro -->
                    <!-- Para cada elemento en $lista_tabla_puestos se genera una etiqueta <option> en el menú desplegable-->
                    <!-- El atributo value de la opción se establece con el valor del campo id del registro actual
                    El texto visible en la opción es el valor del campo nombredelpuesto -->
                    <?php foreach ($lista_tabla_puestos as $registro) { ?>
                        <!-- Comparamos el valor de $idpuesto con el id del puesto actual en $registro.
                        Si son iguales, agrega el atributo selected a la opción, lo que hace que esa opción sea la seleccionada por defecto en el menú desplegable-->
                        <option <?php echo ($idpuesto == $registro['id']) ? "selected" : ""; ?> value="<?php echo $registro['id'] ?>"><?php echo $registro['nombredelpuesto'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
                <input type="date" value="<?php echo $fechadeingreso ?>" class="form-control" name="fechadeingreso">
            </div>
            <!-- Enviamos los datos para el UPDATE de la BD -->
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a class="btn btn-danger" href="index.php">Cenelar</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<br />
<?php include("../footer.php"); ?>