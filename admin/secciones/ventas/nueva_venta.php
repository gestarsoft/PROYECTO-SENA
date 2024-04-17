<?php
session_start();
include("../../bd.php");

// Obtener la lista de productos para la búsqueda
$sentencia_productos = $conexion->prepare("SELECT * FROM `tbl_productos` ");
$sentencia_productos->execute();
$lista_productos = $sentencia_productos->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            Nueva Venta
        </div>
        <div class="card-body">
            <form id="nuevaVentaForm" action="procesar_venta.php" method="post">
                <div class="row mb-3">
                    <div class="col">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="col">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required>
                    </div>
                    <div class="col">
                        <label for="cedula" class="form-label">Cédula:</label>
                        <input type="text" class="form-control" name="cedula" id="cedula" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="celular" class="form-label">Celular:</label>
                        <input type="text" class="form-control" name="celular" id="celular" required>
                    </div>
                    <div class="col">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" required>
                    </div>
                    <div class="col">
                        <label for="metodo_pago" class="form-label">Método de Pago:</label>
                        <select class="form-control" name="metodo_pago" id="metodo_pago" required>
                            <option value="">Seleccione...</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                            <option value="Crédito">Crédito</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="producto" class="form-label">Producto:</label>
                    <select class="form-control" name="producto_id" id="producto" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($lista_productos as $producto) { ?>
                            <option value="<?php echo $producto['ID']; ?>"><?php echo $producto['titulo']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                 <!-- Campo oculto para almacenar el nombre del producto -->
                <input type="hidden" name="nombre_producto" id="nombre_producto">

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Ingrese la cantidad" min="1" required>
                </div>

                <div id="productos-agregados" class="mb-3">
                    <h5>Productos Agregados:</h5>
                    <ul id="lista-productos" class="list-group"></ul>
                </div>

                <button type="button" class="btn btn-primary" onclick="agregarProducto()">Agregar Producto</button>
                <button type="submit" class="btn btn-success">Guardar Venta</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>

<script>
    var productosAgregados = [];

    function agregarProducto() {
        var productoSeleccionado = $("#producto option:selected");
        var cantidad = $("#cantidad").val();
        var productoId = productoSeleccionado.val();
        var productoNombre = productoSeleccionado.text();

        if (productoId && cantidad) {
            var producto = {
                id: productoId,
                nombre: productoNombre,
                cantidad: cantidad
            };

            productosAgregados.push(producto);
            mostrarProductosAgregados();
        } else {
            alert("Por favor seleccione un producto y especifique la cantidad.");
        }
    }

    function quitarProducto(index) {
        productosAgregados.splice(index, 1);
        mostrarProductosAgregados();
    }

    // Actualizar el campo oculto del nombre del producto cuando se selecciona un producto
    $("#producto").change(function() {
        var productoSeleccionado = $(this).find("option:selected").text();
        $("#nombre_producto").val(productoSeleccionado);
    });

    function mostrarProductosAgregados() {
        var listaProductos = $("#lista-productos");
        listaProductos.empty();

        productosAgregados.forEach(function(producto, index) {
            var listItem = $("<li>");
            listItem.addClass("list-group-item");
            listItem.html(`
                ${producto.nombre} - Cantidad: ${producto.cantidad}
                <button type="button" class="btn btn-danger btn-sm" onclick="quitarProducto(${index})">Eliminar</button>
            `);
            listaProductos.append(listItem);
        });
    }
</script>
