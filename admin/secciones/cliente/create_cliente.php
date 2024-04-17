<?php
// Conexión a la base de datos
include("../../bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos del formulario
    $nombre = limpiar_datos($_POST['nombre']);
    $apellido = limpiar_datos($_POST['apellido']);
    $email = limpiar_datos($_POST['email']);
    $telefono = limpiar_datos($_POST['telefono']);
    $direccion = limpiar_datos($_POST['direccion']);

    // Consulta SQL para insertar el nuevo cliente (utilizando una consulta preparada)
    $sql = "INSERT INTO tbl_clientes (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $direccion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Mostrar alerta de SweetAlert2 para confirmación
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Cliente creado exitosamente",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "read_clientes.php";
                });
              </script>';
        exit; // Redirigir después de mostrar la alerta de éxito
    } else {
        echo "Error al crear el cliente: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}

// Función para limpiar datos (puedes expandir esta función según tus necesidades)
function limpiar_datos($dato) {
    return htmlspecialchars(trim($dato));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Script de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Crear Nuevo Cliente</h5>
            </div>
            <div class="card-body">
                <form action="insertar_cliente.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>  
                </form>
            </div>
        </div>
    </div>
</body>
</html>
