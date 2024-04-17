<?php  
include("../../bd.php");

try {
    // Consulta para obtener los tickets junto con los detalles del cliente
    $sql = "SELECT t.id, t.numero_ticket, t.nombre_cliente, t.celular_cliente, t.correo_cliente, t.estado
    FROM tbl_tickets t;";
   

    $resultado = $conexion->query($sql);
    $tickets = $resultado->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mensajeError = "Error al obtener los tickets: " . $e->getMessage();
}

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Lista de Tickets</h3>  
            <a class="btn btn-danger" href="soporte.php" role="button">Nuevo ticket de Soporte técnico</a>
        </div>
        <div class="card-body">
            <?php if (!empty($mensajeError)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $mensajeError; ?>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número de Ticket</th>
                                <th>Nombre del Cliente</th>
                                <th>Celular del Cliente</th>
                                <th>Correo del Cliente</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tickets as $ticket): ?>
                                <tr>
                                    <td><?php echo $ticket['id']; ?></td>
                                    <td><?php echo $ticket['numero_ticket']; ?></td>
                                    <td><?php echo $ticket['nombre_cliente']; ?></td>
                                    <td><?php echo $ticket['celular_cliente']; ?></td>
                                    <td><?php echo $ticket['correo_cliente']; ?></td>
                                    <td><?php echo $ticket['estado']; ?></td>
                                    <td>
                                        <a href="editar_ticket.php?id=<?php echo $ticket['id']; ?>" class="btn btn-primary">Editar</a>
                                        <a href="eliminar_ticket.php?id=<?php echo $ticket['id']; ?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
