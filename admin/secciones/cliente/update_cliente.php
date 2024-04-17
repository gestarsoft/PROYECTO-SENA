<?php
// Conexión a la base de datos
include("../../bd.php");
include("../../templates/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Consulta SQL para actualizar el cliente
    $sql = "UPDATE tbl_clientes SET nombre='$nombre', apellido='$apellido', email='$email', telefono='$telefono', direccion='$direccion' WHERE ID=$id";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Cliente actualizado exitosamente";
    } else {
        echo "Error al actualizar el cliente: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
</head>
<body>
    <h1>Crear Nuevo Cliente</h1>
    <form action="insertar_cliente.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion"><br><br>
        
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
