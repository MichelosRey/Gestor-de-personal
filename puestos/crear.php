<?php
include("../bd.php");

if($_POST){
    print_r($_POST);
    //recuperamos los datos del metodo POST y validamos con isset
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    //preparamos la introduccion de los datos
    //null para el id ya que es autoincremental
    $sql=$conexion->prepare("INSERT INTO tabla_puestos(id,nombredelpuesto) VALUES (null, :nombredelpuesto)");
    //asignando los valores del formulario a traves de POST
    $sql->bindParam(":nombredelpuesto",$nombredelpuesto);
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
<!-- Formulario para enviar los datos que se insertarán en la BD -->
        <form action="" method="post">

            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre Puesto:</label>
                <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto" required/>

            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>

</div>



<?php include("../footer.php"); ?>