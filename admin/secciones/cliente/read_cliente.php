<?php  
include("../../bd.php");

$lista_clientes = []; // Inicializamos la variable como un array vacío

// Seleccionar los registros almacenados en la BD sobre los clientes
$sentencia = $conexion->prepare("SELECT * FROM `tbl_clientes` ");
$sentencia->execute();
$lista_clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header_cliente.php");
?>
<div class="card-header">
    <a class="btn btn-secondary" href="http://localhost/website/admin/index.php?usuario=vendedor" role="button">VOLVER A SECCIÓN PRINCIPAL</a>           
</div> <br>
<div class="container">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="../cliente/create_cliente.php" role="button">Agregar Cliente</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th> 
                            <th scope="col">Nombre</th>                           
                            <th scope="col">Apellido</th>                            
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Acciones</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_clientes as $cliente){ ?>
                            <tr>
                                <td scope="col"><?php echo $cliente['ID']; ?></td>
                                <td scope="col"><?php echo $cliente['nombre']; ?></td>
                                <td scope="col"><?php echo $cliente['apellido']; ?></td>
                                <td scope="col"><?php echo $cliente['email']; ?></td>
                                <td scope="col"><?php echo $cliente['telefono']; ?></td>
                                <td scope="col"><?php echo $cliente['direccion']; ?></td>
                                <td scope="col">
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a class="btn btn-info" href="../cliente/update_cliente.php?txtID=<?php echo $cliente['ID']; ?>" role="button"><i class="fas fa-edit"></i> Editar</a>
                                        <a class="btn btn-danger" href="eliminar.php?txtID=<?php echo $cliente['ID']; ?>" role="button"><i class="fas fa-trash-alt"></i> Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
