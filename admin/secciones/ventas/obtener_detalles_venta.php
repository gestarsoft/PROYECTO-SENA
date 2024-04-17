<?php  
include("../../bd.php");

// Verificar si se recibió el ID de la venta
if(isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];
    // Realizar la consulta para obtener los detalles de la venta
    $sentencia = $conexion->prepare("SELECT * FROM tbl_ventas WHERE ID = :idVenta");
    $sentencia->bindParam(":idVenta", $idVenta);
    $sentencia->execute();
    $detalleVenta = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Comprobar si se encontraron detalles de la venta
    if($detalleVenta) {
        // Mostrar los detalles de la venta en formato de tabla con estilos
        echo '<div class="table-responsive">';
        echo '<table class="table">';
        echo '<tr><th>ID</th><th>Nombre</th><th>Cédula</th><th>Dirección</th><th>Método de pago</th><th>ID Producto</th><th>Cantidad</th><th>Fecha</th><th>Nombre producto</th></tr>';
        echo '<tr>';
        echo '<td>' . $detalleVenta['ID'] . '</td>';
        echo '<td>' . $detalleVenta['cliente_nombre'] . ' ' . $detalleVenta['cliente_apellido'] . '</td>';
        echo '<td>' . $detalleVenta['cliente_cedula'] . '</td>';
        echo '<td>' . $detalleVenta['cliente_direccion'] . '</td>';
        echo '<td>' . $detalleVenta['metodo_pago'] . '</td>';
        echo '<td>' . $detalleVenta['producto_id'] . '</td>';
        echo '<td>' . $detalleVenta['cantidad'] . '</td>';
        echo '<td>' . $detalleVenta['fecha_venta'] . '</td>';
        echo '<td>' . $detalleVenta['nombre_producto'] . '</td>';
        echo '</tr>';
        // Puedes agregar más detalles según la estructura de tu base de datos
        echo '</table>';
        echo '</div>';
    } else {
        // Si no se encuentra la venta, mostrar un mensaje de error
        echo "<p>No se encontraron detalles de la venta.</p>";
    }
} else {
    // Si no se proporciona el ID de la venta, mostrar un mensaje de error
    echo "<p>No se proporcionó el ID de la venta.</p>";
}
?>
