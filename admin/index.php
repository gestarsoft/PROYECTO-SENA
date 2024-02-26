<?php 
include("./templates/header.php"); 

// Verificar si el usuario está autenticado y tiene el rol de Administrador
if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') { 
?>


<br>
<div class="p-5 mb-4 bg-light rounded-3">
    <span class="nav-item nav-link"> 👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?></span> 
    <center><div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenido</h1>
        <p class="col-md-8 fs-4">
          Menú principal   </center>     </p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="../assets/img/usuarios/equipo.png " class="card-img-top" alt="Imagen de usuarios" width="100" height="250">
                <div class="card-body">
                    <center> <h5 class="card-title">Gestión de Usuarios</h5></center>
                    <p class="card-text">Administre los usuarios registrados en el sistema</p>
                    <center> <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/usuarios">Administrar Usuarios</a></center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="../assets/img/portfolio/paquete.png" class="card-img-top" alt="Imagen de usuarios" width="80" height="250">
                <div class="card-body">
                    <center> <h5 class="card-title">Gestión de Productos</h5></center>
                    <p class="card-text">Administre los productos registrados en la tienda</p>
                    <center> <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/portafolio">Administrar productos</a></center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="../assets/img/servicios/atencion-al-cliente.png" class="card-img-top" alt="Imagen de usuarios" width="80" height="250">
                <div class="card-body">
                    <center> <h5 class="card-title">Gestión de Servicios</h5></center>
                    <p class="card-text">Administre los Servicios disponibles en la tienda</p>
                    <center> <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/servicios">Administrar Servicios</a></center>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
} elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Vendedor') { // Verificar si el usuario tiene el rol de Vendedor
?>

<br>
<div class="p-5 mb-4 bg-light rounded-3">
    <span class="nav-item nav-link"> 👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?></span> 
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenido</h1>
        <p class="col-md-8 fs-4">
            En este dasboard usted podrá controlar los productos disponibles en la tienda.
        </p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center"> <!-- Agregar la clase text-center para centrar el contenido -->
            <div class="card d-inline-block"> <!-- Agregar la clase d-inline-block para que la tarjeta ocupe solo el ancho necesario -->
                <img src="../assets/img/portfolio/paquete.png" class="card-img-top" alt="Imagen de usuarios" width="80" height="250">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Productos</h5>
                    <p class="card-text">Administrar los productos registrados en la tienda</p>
                    <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/portafolio">Administrar productos</a>
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
?>
