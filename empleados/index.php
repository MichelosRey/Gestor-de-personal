<?php

//Conectamos con el archivo que contiene los detalles de la conexión a la BD
include("../bd.php");

//Verificamos si se ha proporcionado el parámetro txtID a través de la URL
if (isset($_GET['txtID'])) {
    //Asignamos a la variable $txtID el valor de 'txtID' si está en la URL
    $txtID = $_GET['txtID'];
    //Preparamos la consulta para eliminar un registro de la tabla tabla_empleados donde el campo id coincide con el valor proporcionado en :id
    $sql = $conexion->prepare("DELETE FROM tabla_empleados WHERE id=:id");
    //Asociamos el valor de $txtID al marcador de posición :id en la consulta SQL anterior
    $sql->bindParam(":id", $txtID);
    //Ejecutamos la consulta SQL elimiando el registro 
    $sql->execute();
    //Después de la eliminación, redirigimos al usuario a la página "index.php".
    header("Location:index.php");
}

//Obtenemos los datos de empleados y puestos

//Realizamos una consulta para obtener todos los registros de la tabla tabla_empleados.
//y utilizamos una subconsulta para obtener el nombre del puesto relacionado con cada empleado
$sql = $conexion->prepare("SELECT * ,(SELECT nombredelpuesto FROM tabla_puestos WHERE tabla_puestos.id=tabla_empleados.idpuesto limit 1) as puesto FROM `tabla_empleados`");
$sql->execute();
//Almacena los resultados en la variable $lista_tabla_empleados como un array asociativo.
$lista_tabla_empleados = $sql->fetchAll(PDO::FETCH_ASSOC);
$conexion = null;
?>

<!-- Incluimos el archivo header.php-->
<?php include("../header.php"); ?>


<br />
<h4>Empleados</h4>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Añadir Empleado</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <!-- Creamos una tabla para mostrar los registros de la tabla empleados -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Primer apellido</th>
                        <th scope="col">Segundo apellido</th>
                        <th scope="col">Puesto</th>

                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Con este foreach generamos filas de una tabla HTML con información de una lista de registros -->
                    <!-- Iteramos sobre cada elemento del array almacenado en la variable $lista_tabla_empleados y lo almacenamos en $registro -->
                    <?php foreach ($lista_tabla_empleados as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id'] ?></td>
                            <td scope="row"><?php echo $registro['nombre'] ?></td>
                            <td><?php echo $registro['primerapellido'] ?></td>
                            <td><?php echo $registro['segundoapellido'] ?></td>
                            <td><?php echo $registro['puesto'] ?></td>

                            <td>
                                <a name="" id="" class="btn btn-primary" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button">Editar</a>
                                |
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id'] ?>" role="button">Eliminar</a>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>
</div>

<br />
<!-- Incluimos el archivo footer.php-->
<?php include("../footer.php"); ?>