<?php
// Incluir archivo de conexión a la base de datos
include("../../bd.php");

// Incluir archivo de configuración de estilos
include("../../templates/header.php");

// Consulta para obtener la lista de clientes
$sentencia = $conexion->prepare("SELECT * FROM clientes");
$sentencia->execute();
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-text {
            color: #666;
            font-size: 1rem;
        }
        .btn-custom {
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            padding: 15px 25px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-primary-custom:hover {
            background-color: #0056b3;
        }
        .btn-secondary-custom {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }
        .btn-secondary-custom:hover {
            background-color: #5a6268;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .btn-danger-custom:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body id="page-top">
    <!-- Contenido del body aquí -->
   

    <section class="page-section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Gestión de Clientes</h5>
                    <p class="card-text text-center">Administre la información de los clientes</p>
                    <div class="text-center">
                        <a href="../cliente/create_cliente.php" class="btn btn-custom btn-primary-custom">Crear Cliente</a>
                        <a href="../cliente/read_cliente.php" class="btn btn-custom btn-secondary-custom">Ver Clientes</a>
                        <!-- Agrega aquí los enlaces a las demás funcionalidades del CRUD -->
                        <a href="cliente/update_cliente.php" class="btn btn-custom btn-secondary-custom">Actualizar Cliente</a>
                        <a href="cliente/delete_cliente.php" class="btn btn-custom btn-danger-custom">Eliminar Cliente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
    <?php include("../../templates/footer.php");?>
  <!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
