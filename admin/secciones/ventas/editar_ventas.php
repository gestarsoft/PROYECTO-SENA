<?php  
include("../../bd.php");

// Verificar si se ha enviado el formulario
if(isset($_POST['editar'])){
    $venta_id = $_POST['venta_id'];
    $cliente_nombre = $_POST['cliente_nombre'];
    $cliente_apellido = $_POST['cliente_apellido'];
    $metodo_pago = $_POST['metodo_pago'];
    $cantidad = $_POST['cantidad'];

    // Obtener la información de la venta antes de la edición
    $sentencia_venta_anterior = $conexion->prepare("SELECT * FROM `tbl_ventas` WHERE ID=:id");
    $sentencia_venta_anterior->bindParam(":id", $venta_id);
    $sentencia_venta_anterior->execute();
    $venta_anterior = $sentencia_venta_anterior->fetch(PDO::FETCH_ASSOC);
    $cantidad_anterior = $venta_anterior['cantidad'];
    $producto_id = $venta_anterior['producto_id'];

    // Actualizar la venta en la base de datos
    $sentencia = $conexion->prepare("UPDATE `tbl_ventas` SET cliente_nombre=:cliente_nombre, cliente_apellido=:cliente_apellido, metodo_pago=:metodo_pago, cantidad=:cantidad WHERE ID=:id");
    $sentencia->bindParam(":id", $venta_id);
    $sentencia->bindParam(":cliente_nombre", $cliente_nombre);
    $sentencia->bindParam(":cliente_apellido", $cliente_apellido);
    $sentencia->bindParam(":metodo_pago", $metodo_pago);
    $sentencia->bindParam(":cantidad", $cantidad);
    $resultado = $sentencia->execute();

    if($resultado) {
        // Obtener la diferencia de cantidad para actualizar el stock del producto
        $diferencia_cantidad = $cantidad_anterior - $cantidad;
        $nuevo_stock = $venta_anterior['cantidad'] + $cantidad;

        // Actualizar el stock del producto
        $sentencia_actualizar_stock = $conexion->prepare("UPDATE `tbl_productos` SET cantidad = cantidad + :diferencia WHERE ID = :producto_id");
        $sentencia_actualizar_stock->bindParam(":diferencia", $diferencia_cantidad);
        $sentencia_actualizar_stock->bindParam(":producto_id", $producto_id);
        $sentencia_actualizar_stock->execute();

        $mensaje = "Venta actualizada correctamente!";
        // Redireccionar a la página de ventas
        header("Location: index.php");
        exit();
    } else {
        $mensaje = "Error al actualizar la venta.";
    }

    // Redireccionar a la página de ventas con el mensaje correspondiente
    header("Location: ventas.php?mensaje=" . urlencode($mensaje));
    exit();
}

// Obtener el ID de la venta a editar
if(isset($_GET['txtID'])){
    $venta_id = $_GET['txtID'];

    // Obtener la información de la venta desde la base de datos
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_ventas` WHERE ID=:id");
    $sentencia->bindParam(":id", $venta_id);
    $sentencia->execute();
    $venta = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Obtener información adicional del método de pago
    $metodo_pago = $venta['metodo_pago'];
} else {
    // Redirigir si no se proporciona un ID válido
    header("Location: ventas.php");
    exit();
}

include("../../templates/header_ventas.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            Editar Venta
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <input type="hidden" name="venta_id" value="<?php echo $venta['ID']; ?>">
                
                <div class="mb-3">
                    <label for="cliente_nombre" class="form-label">Nombre del Cliente:</label>
                    <input type="text" class="form-control" name="cliente_nombre" id="cliente_nombre" value="<?php echo $venta['cliente_nombre']; ?>" required />
                </div>
                
                <div class="mb-3">
                    <label for="cliente_apellido" class="form-label">Apellido del Cliente:</label>
                    <input type="text" class="form-control" name="cliente_apellido" id="cliente_apellido" value="<?php echo $venta['cliente_apellido']; ?>" required />
                </div>
                
                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago:</label>
                    <input type="text" class="form-control" name="metodo_pago" id="metodo_pago" value="<?php echo $metodo_pago; ?>" readonly />
                </div>
                
               
                
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" value="<?php echo $venta['cantidad']; ?>" required />
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success" name="editar">Actualizar Venta</button>
                    <a href="index.php" class="btn btn-primary">Cancelar</a>
                </div>                     
            </form>
        </div>
    </div>
</div>



<?php include("../../templates/footer.php");?>

<?php
// Función para obtener el nombre del producto basado en su ID
function obtenerNombreProducto($id) {
    include("../../bd.php");
    $sentencia = $conexion->prepare("SELECT titulo FROM `tbl_producto` WHERE ID = :id");
    $sentencia->bindParam(":id", $id);
    $sentencia->execute();
    $producto = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $producto['titulo'];
}
?>
