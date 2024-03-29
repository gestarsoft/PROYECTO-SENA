<?php 
include("./templates/header.php"); 

// Verificar si el usuario está autenticado y tiene el rol de Administrador
if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') { 
?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-secondary text-center" role="alert">
                👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Bienvenido</h5>
                    <p class="card-text text-center">Menú principal</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3"> <!-- Ajustar el tamaño de la columna a col-md-3 -->
            <div class="card">
                <img src="../assets/img/usuarios/equipo.png" class="card-img-top" alt="Imagen de usuarios">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <p class="card-text">Administre los usuarios registrados en el sistema</p>
                    <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/usuarios">Administrar Usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"> <!-- Ajustar el tamaño de la columna a col-md-3 -->
            <div class="card">
                <img src="../assets/img/portfolio/paquete.png" class="card-img-top" alt="Imagen de productos">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestión de Productos</h5>
                    <p class="card-text">Administre los productos registrados en la tienda</p>
                    <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/portafolio">Administrar Productos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"> <!-- Ajustar el tamaño de la columna a col-md-3 -->
            <div class="card">
                <img src="../assets/img/servicios/atencion-al-cliente.png" class="card-img-top" alt="Imagen de servicios">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestión de Servicios</h5>
                    <p class="card-text">Administre los servicios disponibles en la tienda</p>
                    <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/servicios">Administrar Servicios</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"> <!-- Ajustar el tamaño de la columna a col-md-3 -->
            <div class="card">
                <img src="../assets/img/ventas/logo.png" class="card-img-top" alt="Imagen de servicios">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestión de Ventas</h5>
                    <p class="card-text">Administre los servicios disponibles en la tienda</p>
                    <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/ventas">Administrar Ventas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
} elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Vendedor') { // Verificar si el usuario tiene el rol de Vendedor
?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-secondary text-center" role="alert">
                👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Bienvenido</h5>
                    <p class="card-text text-center">En este dashboard usted podrá controlar los productos disponibles en la tienda.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <img src="../assets/img/portfolio/paquete.png" class="card-img-top" alt="Imagen de productos">
                <div class="card-body text-center">
                    <h5 class="card-title">Gestión de Productos</h5>
                    <p class="card-text">Administrar los productos registrados en la tienda</p>
                    <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/portafolio">Administrar Productos</a>
                </div>
            </div>
        </div>
    </div>
</div>
 
<?php 
// Agregar la tabla de resumen de compra para el cliente
} elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Cliente') { // Verificar si el usuario tiene el rol de Cliente
?>
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Resumen de Compra</h2>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí deberías incluir un bucle para mostrar los productos comprados por el cliente -->
                        <tr>
                            <td>1</td>
                            <td>Producto 1</td>
                            <td>2</td>
                            <td>2024-02-22</td>
                            <td>$20.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Producto 2</td>
                            <td>1</td>
                            <td>2024-02-22</td>
                            <td>$10.00</td>
                        </tr>
                        <!-- Fin del bucle -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
}

include("./templates/footer.php"); 

// Script para mostrar el alert de bienvenida
if(isset($_GET['usuario'])) {
?>
    <script>
        // Obtener el nombre de usuario de la URL
        var usuario = "<?php echo $_GET['usuario']; ?>";

        // Mostrar el alert de bienvenida
        alert("¡Bienvenido, " + usuario + "!");
    </script>
<?php
}
?>
