<?php
//Conectamos con el archivo que contiene los detalles de la conexión a la BD
include("../bd.php");

//Verificamos si se ha proporcionado el parámetro txtID a través de la URL
if (isset($_GET['txtID'])) {
    
    //Asignamos a la variable $txtID el valor de 'txtID' si está en la URL
    $txtID = (isset($_GET['txtID']));

    //Preparamos la consulta para eliminar un registro de la tabla tabla_puestos donde el campo id coincide con el valor proporcionado en :id
    $sql = $conexion->prepare("DELETE FROM tabla_puestos WHERE id=:id");

    //Asociamos el valor de $txtID al marcador de posición :id en la consulta SQL anterior
    $sql->bindParam(":id", $txtID);

    //Ejecutamos la consulta SQL elimiando el registro 
    $sql->execute();
}

//Consulta para obtener todos los registros de la tabla 'tabla_puestos'
$sql = $conexion->prepare("SELECT * FROM `tabla_puestos`");
$sql->execute();
//Almacenamos los resultados de la consulta como un array asociativo dentro de la vaiable $lista_tabla_puestos
$lista_tabla_puestos = $sql->fetchAll(PDO::FETCH_ASSOC);

$conexion = null;
?>

<!-- Incluimos el archivo header.php-->
<?php include("../header.php"); ?>
<br />

<h4>Puestos</h4>
<div class="card">
    <div class="card-header">
        <!-- Enlace que envía a la pagina 'crear.php' para crear un nuevo puesto de trabajo -->
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Añadir Puesto</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
        <!-- Creamos una tabla para mostrar los registros de la tabla puestos -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Con este foreach generamos filas de una tabla con información de $lista_tabla_puestos-->
                    <!-- Iteramos sobre cada elemento del array de la variable $lista_tabla_puestos y lo almacenamos en $registro y los muestra-->
                    <?php foreach ($lista_tabla_puestos as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id'] ?></td>
                            <td><?php echo $registro['nombredelpuesto'] ?></td>
                            <td>
                                <a name="" id="" class="btn btn-primary" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button">Editar</a>
                                |
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id'] ?>" role="button">Eliminar</a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Incluimos el archivo footer.php-->
<?php include("../footer.php"); ?>






