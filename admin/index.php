<?php 
session_start();

// Redireccionar si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: http://localhost/website/admin/login.php");
    exit(); // Terminar el script después de redireccionar
}

// Determinar qué archivo de encabezado incluir basado en el rol del usuario
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 'Administrador') {
        include("./templates/header.php");
    } elseif ($_SESSION['rol'] == 'Vendedor') {
        include("./templates/header_vendedor.php");
    } elseif ($_SESSION['rol'] == 'Cliente') {
        include("./templates/header_cliente.php");
    } else {
        // Manejar cualquier otro caso de rol aquí
        echo "Rol no válido";
        exit(); // Terminar el script si el rol no es válido
    }
} else {
    // Si no se ha establecido el rol, mostrar un mensaje de error y salir
    echo "Rol no definido";
    exit();
}
?>

<br>
<div class="container">
    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-secondary text-center" role="alert">
                    👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?>
                </div>
                </div>

                <!-- //Logo y titulo del menu  -->
                <div class="card bg-light mb-3">
    <div class="card-body text-center">
        <div class="row align-items-center">
            <div class="col-md-12 mb-3">
                <!-- Aquí se mostraría el logo del negocio -->
                <img src="../assets/img/logos/tienda.avif" class="img-fluid mx-auto d-block" alt="Logo del negocio" style="max-width: 400px; max-height: 150px;">
            </div>
            <div class="col-md-12">
                <h5 class="card-title text-center">Bienvenido</h5>
                <p class="card-text text-center">Menú principal / Módulos del software 🔻</p>
            </div>
        </div>
    </div>
</div>
<!-- hasta aqui logo e del negocio y titulo del menu  -->

</div>

        </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                   <center> <img src="../assets/img/usuarios/equipo.png" class="card-img-top img-fluid" alt="Imagen de usuarios" style="max-width: 80px; max-height: 80px;"></center>
                    <div class="card-body text-center">
                        <h5 class="card-title">USUARIOS DEL SISTEMA</h5>
                        <p class="card-text">Administre los usuarios registrados en el sistema</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/usuarios">Administrar Usuarios</a>
                    </div>
                </div> <br>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <center><img src="../assets/img/portfolio/paquete.png" class="card-img-top img-fluid" alt="Imagen de productos" style="max-width: 80px; max-height: 80px;"></center>
                    <div class="card-body text-center">
                        <h5 class="card-title">PRODUCTOS</h5>
                        <p class="card-text">Administre los productos registrados en la tienda</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/productos">Administrar Productos</a>
                    </div>
                </div> <br>
            </div>
            <div class="col-md-6">
                <div class="card">
                  <center> <img src="../assets/img/servicios/atencion-al-cliente.png" class="card-img-top img-fluid" alt="Imagen de servicios" style="max-width: 80px; max-height: 80px;"></center> 
                    <div class="card-body text-center">
                        <h5 class="card-title">SERVICIOS</h5>
                        <p class="card-text">Módulo de Gestión de servicio técnico </p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/servicios">Administrar Servicios</a>
                    </div>
                </div> <br>
            </div> <br>
            <div class="col-md-6">
                <div class="card">
                   <center> <img src="../assets/img/ventas/logo.png" class="card-img-top img-fluid" alt="Imagen de servicios" style="max-width: 80px; max-height: 80px;"></center>
                    <div class="card-body text-center">
                        <h5 class="card-title">VENTAS</h5>
                        <p class="card-text">Gestión de venta de articulos de la vitrina</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/ventas">Administrar Ventas</a>
                    </div>
                </div>
            </div> <br>
            <div class="col-md-6">
                <div class="card">
                    <center><img src="../assets/img/ventas/logo.png" class="card-img-top img-fluid" alt="Imagen de servicios" style="max-width: 80px; max-height: 80px;"></center>
                    <div class="card-body text-center">
                        <h5 class="card-title">TIENDA</h5>
                        <p class="card-text">Administrar Vitrina</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/tienda">Administrar Ventas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <center><img src="../assets/img/usuarios/cl3.png" class="card-img-top img-fluid" alt="Imagen de servicios" style="max-width: 80px; max-height: 80px;"></center>
                    <div class="card-body text-center">
                        <h5 class="card-title">ADMINISTRAR MIS CLIENTES</h5>
                        <p class="card-text">Gestionar mis clientes</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/cliente">Gestión de clientes</a>
                    </div>
                </div>
            </div>
        </div>
        <br> <br> <br>
    <?php } elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Vendedor') { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-secondary text-center" role="alert">
                    👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?>
                </div>
                <div class="col-md-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Bienvenido</h5>
                        <p class="card-text text-center">En este dashboard usted podrá controlar los productos disponibles en la tienda.</p>
                    </div>                    
                </div>
                
            </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <img src="../assets/img/portfolio/paquete.png" class="card-img-top img-fluid" alt="Imagen de productos" style="max-width: 80px; max-height: 80px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Productos</h5>
                        <p class="card-text">Administrar los productos registrados en la tienda</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/productos">Administrar Productos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="../assets/img/ventas/logo.png" class="card-img-top img-fluid" alt="Imagen de servicios" style="max-width: 80px; max-height: 80px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestión de Ventas</h5>
                        <p class="card-text">Administre los servicios disponibles en la tienda</p>
                        <a class="btn btn-primary" href="<?php echo $url_base;?>/secciones/ventas">Administrar Ventas</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 'Cliente') { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-secondary text-center" role="alert">
                    👤 <?php echo $_SESSION['usuario'] . ' [' . $_SESSION['rol'] . ']'; ?>
                </div>
                <div class="col-md-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Gestión de Clientes</h5>
                        <p class="card-text text-center">Administre la información de los clientes</p>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="cliente/create_cliente.php">Crear Cliente</a></li>
                            <li class="list-group-item"><a href="cliente/read_cliente.php">Ver Clientes</a></li>
                            <!-- Agrega aquí los enlaces a las demás funcionalidades del CRUD -->
                            <li class="list-group-item"><a href="cliente/update_cliente.php">Actualizar Cliente</a></li>
                            <li class="list-group-item"><a href="cliente/delete_cliente.php">Eliminar Cliente</a></li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    <?php } ?>


<?php 
include("./templates/footer.php"); 

// Script para mostrar el alert de bienvenida
if(isset($_GET['usuario'])) {
?>
    <script>
        // Obtener el nombre de usuario de la URL
        var usuario = "<?php echo $_GET['usuario']; ?>";

        // Mostrar el alert de bienvenida
        // alert("¡Bienvenido!" );
    </script>
<?php
}
?>
