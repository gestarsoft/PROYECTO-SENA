<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //Borrar dicho registro con el ID correspondiente
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje = "Registro borrado correctamente!";
    header("Location:index.php?mensaje=" . $mensaje);
}

//Seleccionar los registros almacenados en la BD sobre los servicios que se han creado.
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios` ");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Rol</th>                
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_usuarios as $registros) { ?>
                            <tr>
                                <td><?php echo $registros['ID'];?></td>
                                <td><img src="../../assets/uploads/<?php echo $registros['foto'];?>" alt="Foto de perfil" width="50"></td>
                                <td><?php echo $registros['usuario'];?></td>
                                <td><?php echo $registros['correo'];?></td>
                                <td><?php echo password_hash($registros['password'], PASSWORD_DEFAULT);?></td> <!-- Encriptar la contraseña antes de mostrarla -->
                                <td><?php echo $registros['rol'];?></td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                    <a class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
