<?php  
include("../../bd.php");

// Procesar el formulario de creación de ventas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí deberías agregar el código para procesar los datos del formulario y registrar la venta en la base de datos
    // Recuerda validar y limpiar los datos antes de usarlos en consultas SQL
    // Una vez registrada la venta, puedes redirigir al usuario a la página de inicio o mostrar un mensaje de éxito
    // Ejemplo de procesamiento de datos:
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $cliente = $_POST['cliente'];
    // Continuar con el procesamiento y registro de la venta en la base de datos...
}

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Agregar Venta</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="producto">Producto:</label>
                    <input type="text" class="form-control" id="producto" name="producto" required>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                </div>
                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" required>
                </div>
                <!-- Agregar más campos según sea necesario para la venta -->
                <button type="submit" class="btn btn-primary">Registrar Venta</button>
            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
