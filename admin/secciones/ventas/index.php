<?php  
include("../../bd.php");

// Verificar si se ha enviado el formulario de edición
if(isset($_POST['editar'])){
    // Código para editar la venta...
}

// Verificar si se ha enviado el formulario de eliminación
if(isset($_POST['eliminar'])){
    if(isset($_POST['ventas_seleccionadas'])){
        $ventas_seleccionadas = $_POST['ventas_seleccionadas'];

        // Eliminar las ventas seleccionadas de la base de datos
        foreach($ventas_seleccionadas as $venta_id) {
            $sentencia = $conexion->prepare("DELETE FROM `tbl_ventas` WHERE ID=:id");
            $sentencia->bindParam(":id", $venta_id);
            $resultado = $sentencia->execute();
        }

        // Redireccionar a la página de ventas con el mensaje correspondiente
        if($resultado) {
            $mensaje = "Ventas eliminadas correctamente!";
        } else {
            $mensaje = "Error al eliminar las ventas.";
        }
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit();
    }
}

// Obtener las ventas de la base de datos
$lista_ventas = [];
$sentencia = $conexion->prepare("SELECT * FROM `tbl_ventas` ");
$sentencia->execute();
$lista_ventas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header_vendedor.php");

?>
<div class="card-header">
    <a class="btn btn-secondary" href="http://localhost/website/admin/index.php?usuario=vendedor" role="button">VOLVER A SECCIÓN PRINCIPAL</a>           
</div> <br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="nueva_venta.php" role="button">Nueva Venta</a>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="seleccionarTodo">
                <label class="form-check-label" for="seleccionarTodo">Seleccionar Todo</label>
            </div>           
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Seleccionar</th> 
                                <th scope="col">ID</th> 
                                <th scope="col">Cliente</th>                           
                                <th scope="col">Acciones</th>                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lista_ventas as $venta){ ?>
                                <tr>
                                    <td scope="col"><input type="checkbox" name="ventas_seleccionadas[]" value="<?php echo $venta['ID']; ?>"></td>
                                    <td scope="col"><?php echo $venta['ID']; ?></td>
                                    <td scope="col"><?php echo $venta['cliente_nombre'] . ' ' . $venta['cliente_apellido']; ?></td>
                                    <td scope="col">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a class="btn btn-info" href="editar_ventas.php?txtID=<?php echo $venta['ID']; ?>" role="button"><i class="fas fa-edit"></i> Editar</a>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type="hidden" name="venta_id" value="<?php echo $venta['ID']; ?>">
                                                <button type="submit" class="btn btn-danger" name="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta?')"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-ver-detalles" data-id="<?php echo $venta['ID']; ?>"><i class="fas fa-eye"></i> Ver Detalles</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-danger" name="eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar las ventas seleccionadas?')"><i class="fas fa-trash-alt"></i> Eliminar Seleccionados</button>
            </form>
        </div>
    </div>
</div>

<!-- Ventana modal para mostrar los detalles de la venta -->
<div class="modal fade" id="detalleVentaModal" tabindex="-1" aria-labelledby="detalleVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleVentaModalLabel">Detalles de la Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí se cargarán los detalles de la venta -->
            </div>
        </div>
    </div>
</div>

<!-- Script para cargar los detalles de la venta en el modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Función para seleccionar/deseleccionar todas las ventas
    $("#seleccionarTodo").change(function() {
        $("input[name='ventas_seleccionadas[]']").prop('checked', $(this).prop("checked"));
    });

    // Función para cargar los detalles de la venta en el modal
    function mostrarDetallesVenta(idVenta) {
        $.get("obtener_detalles_venta.php?idVenta=" + idVenta, function(data) {
            $("#detalleVentaModal .modal-body").html(data);
            $("#detalleVentaModal").modal("show");
        });
    }

    // Asignar evento clic a los botones "Ver Detalles"
    $(".btn-ver-detalles").click(function() {
        var idVenta = $(this).data("id");
        mostrarDetallesVenta(idVenta);
    });
});
</script>

<?php include("../../templates/footer.php");?>
