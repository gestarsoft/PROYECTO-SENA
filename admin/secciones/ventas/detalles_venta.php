<?php 
include("../../bd.php");

if(isset($_GET['id'])){
    $venta_id = $_GET['id'];

    // Obtener los detalles de la venta correspondiente al ID proporcionado
    $sentencia_venta = $conexion->prepare("SELECT * FROM `tbl_ventas` WHERE ID=:id");
    $sentencia_venta->bindParam(":id", $venta_id);
    $sentencia_venta->execute();
    $venta = $sentencia_venta->fetch(PDO::FETCH_ASSOC);

    // Verificar si la venta existe
    if(!$venta) {
        echo "La venta con el ID proporcionado no existe.";
        exit();
    }
} else {
    // Si no se proporciona un ID de venta, redireccionar al index de ventas
    header("Location: index.php");
    exit();
}

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            Detalles de la Venta
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> <?php echo isset($venta['cliente_nombre']) ? $venta['cliente_nombre'] . ' ' . $venta['cliente_apellido'] : ''; ?></p>
            <p><strong>ID del Producto:</strong> <?php echo isset($venta['producto_id']) ? $venta['producto_id'] : ''; ?></p>
            <p><strong>Cantidad vendida:</strong> <?php echo isset($venta['cantidad']) ? $venta['cantidad'] : ''; ?></p>
            <p><strong>Método de Pago:</strong> <?php echo isset($venta['metodo_pago']) ? $venta['metodo_pago'] : ''; ?></p>
            <!-- Aquí puedes mostrar más detalles de la venta según tu base de datos -->
            <a href="editar_venta.php?id=<?php echo $venta['ID']; ?>" class="btn btn-info">Editar Venta</a>
            <a href="eliminar_venta.php?id=<?php echo $venta['ID']; ?>" class="btn btn-danger">Eliminar Venta</a>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
