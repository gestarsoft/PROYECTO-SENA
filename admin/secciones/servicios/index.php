<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Borrar el registro con el ID correspondiente
    $sentencia = $conexion->prepare("DELETE FROM `tbl_servicios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    
    $mensaje = "Registro borrado correctamente!";
    header("Location:index.php?mensaje=".$mensaje);
}

// Seleccionar los registros almacenados en la BD sobre los servicios que se han creado.
$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios` ");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="crear.php" role="button">Agregar Servicios en la web</a>
            <a class="btn btn-success" href="tickets.php" role="button">Gestion de Soporte técnico</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Icono</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_servicios as $registros){ ?>
                            <tr>
                                <td><?php echo $registros['ID']; ?></td>
                                <td><?php echo $registros['icono']; ?></td>
                                <td><?php echo $registros['titulo']; ?></td>
                                <td><?php echo $registros['descripcion']; ?></td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                    |
                                    <a class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
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
