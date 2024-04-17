<?php
// Verificar si la sesión no está activa antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$url_base = "http://localhost/website/admin";
if (!isset($_SESSION['usuario'])) {
    header("Location: {$url_base}/login.php");
    exit; // Asegura que el script se detenga después de redirigir
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Bienvenido administrador del sitio web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf-8" src=" https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="container-fluid">
                <!-- Módulos de gestión -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <h1>Bienvenido al módulo de ventas</h1>
                        </li>
                       
                    </ul>
                </div>

                <!-- Módulos a la derecha -->
                <div class="d-flex">
                    <span class="nav-item nav-link"><?php echo $_SESSION['usuario']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="nav-item nav-link"><?php echo date("d-m-Y H:i:s"); ?></span> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/./cerrar.php" >Cerrar Sesión 🔒</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
                </div>
            </div>
        </nav> 
        <!-- Fin de Navbar -->

        <!-- Enlace a la página principal -->
        <br><br>
        <center><a href="http://localhost/website/" class="btn btn-primary">Ir a la página principal de la tienda tecnológica</a></center>
    </header>

    <main class="container">
        <br/>
        <script>
        <?php if(isset($_GET['mensaje'])){?>        
        Swal.fire({icon:"success",timer: 1000,title:"<?php echo $_GET['mensaje']; ?>"});
        <?php } ?>
        </script>
