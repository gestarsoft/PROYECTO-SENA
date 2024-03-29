<?php 
include("../../bd.php");

// Proceso para eliminar una venta si se proporciona un ID en la URL
if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Borrar el registro con el ID correspondiente
    $sentencia = $conexion->prepare("DELETE FROM `tbl_ventas` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    
    $mensaje = "Registro borrado correctamente!";
    header("Location:index.php?mensaje=".$mensaje);
}

// Seleccionar los registros almacenados en la BD sobre las ventas
$sentencia = $conexion->prepare("SELECT * FROM `tbl_ventas` ");
$sentencia->execute();
$lista_ventas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="procesar_venta.php" role="button">Agregar Venta</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_ventas as $venta){ ?>
                            <tr>
                                <td><?php echo $venta['ID']; ?></td>
                                <td><?php echo $venta['producto']; ?></td>
                                <td><?php echo $venta['cantidad']; ?></td>
                                <td><?php echo $venta['cliente']; ?></td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $venta['ID']; ?>" role="button">Editar</a>
                                    |
                                    <a class="btn btn-danger" href="index.php?txtID=<?php echo $venta['ID']; ?>" role="button">Eliminar</a>
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
