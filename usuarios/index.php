<?php include("../bd.php");
//Verificamos si se ha proporcionado el parámetro txtID a través de la URL
if (isset($_GET['txtID'])) {
    //Asignamos a la variable $txtID el valor de 'txtID' si está en la URL
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    //Preparamos la consulta para eliminar un registro de la tabla tabla_usuarios donde el campo id coincide con el valor proporcionado en :id
    $sql = $conexion->prepare("DELETE FROM tabla_usuarios WHERE id=:id");
    //Asociamos el valor de $txtID al marcador de posición :id en la consulta SQL anterior y ejecutamos
    $sql->bindParam(":id", $txtID);
    $sql->execute();
}
//Consulta para obtener todos los registros de la tabla/Consulta para obtener todos los registros de la tabla usuarios
$sql = $conexion->prepare("SELECT * FROM `tabla_usuarios`");
$sql->execute();
//Almacenamos los resultados de la consulta como un array asociativo dentro de la vaiable $lista_tabla_usuarios
$lista_tabla_usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

$conexion = null;
?>



<?php include("../header.php"); ?>

<br />

<h4>Usuarios</h4>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">nombre</th>
                        <th scope="col">contraseña</th>
                        <th scope="col">correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Con este foreach generamos filas de una tabla con información de $lista_tabla_usuarios-->
                    <!-- Iteramos sobre cada elemento del array de la variable $lista_tabla_usuarios y lo almacenamos en $registro y los muestra-->
                    <?php foreach ($lista_tabla_usuarios as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id'] ?></td>
                            <td><?php echo $registro['usuario'] ?></td>
                            <td>*********</td>
                            <td><?php echo $registro['correo'] ?></td>
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






<?php include("../footer.php"); ?>