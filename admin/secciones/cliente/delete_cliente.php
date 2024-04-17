<?php
// Conexión a la base de datos
include("../../bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del cliente a eliminar
    $id = $_POST['id'];

    // Consulta SQL para eliminar el cliente
    $sql = "DELETE FROM tbl_clientes WHERE ID=$id";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Cliente eliminado exitosamente";
    } else {
        echo "Error al eliminar el cliente: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
