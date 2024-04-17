<?php
session_start();
include("../../bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $celular = $_POST["celular"];
    $direccion = $_POST["direccion"];
    $metodo_pago = $_POST["metodo_pago"];
    $producto_id = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"];
    $nombre_producto = $_POST["nombre_producto"]; // Nuevo campo

    // Preparar la consulta SQL
    $query = "INSERT INTO `tbl_ventas` 
                (`cliente_nombre`, `cliente_apellido`, `cliente_cedula`, `cliente_celular`, `cliente_direccion`, `metodo_pago`, `producto_id`, `cantidad`, `nombre_producto`)
              VALUES 
                (:cliente_nombre, :cliente_apellido, :cliente_cedula, :cliente_celular, :cliente_direccion, :metodo_pago, :producto_id, :cantidad, :nombre_producto)";

    // Preparar y ejecutar la consulta
    $statement = $conexion->prepare($query);
    $statement->bindParam(":cliente_nombre", $nombre);
    $statement->bindParam(":cliente_apellido", $apellido);
    $statement->bindParam(":cliente_cedula", $cedula);
    $statement->bindParam(":cliente_celular", $celular);
    $statement->bindParam(":cliente_direccion", $direccion);
    $statement->bindParam(":metodo_pago", $metodo_pago);
    $statement->bindParam(":producto_id", $producto_id);
    $statement->bindParam(":cantidad", $cantidad);
    $statement->bindParam(":nombre_producto", $nombre_producto); // Nuevo campo
    $result = $statement->execute();

    // Verificar si la consulta fue exitosa
    if ($result) {
        // Redireccionar con mensaje de éxito
        header("Location: index.php?mensaje=" . urlencode("Venta guardada correctamente"));
        exit();
    } else {
        // Redireccionar con mensaje de error
        header("Location: index.php?mensaje=" . urlencode("Error al guardar la venta"));
        exit();
    }
} else {
    // Si el método de solicitud no es POST, redireccionar a la página de inicio
    header("Location: index.php");
    exit();
}
?>
