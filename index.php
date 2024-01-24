<!-- Incluimos el archivo header.php-->
<?php include("header.php"); ?>

<br />

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5 text-center">
        <!-- mostramos el nombre de usuario almacenado en la variable de sesión $_SESSION['usuario'] -->
        <h1 class="display-5 fw-bold">¡Hola de nuevo <?php echo $_SESSION ['usuario']?>!</h1>
        <br/>
        <h4 class="display-6">Bienvenido a tú sistema de gestor de empleados.</h4>
        
    
    </div>
</div>
<!-- Incluimos el archivo footer.php-->
<?php include("footer.php"); ?>