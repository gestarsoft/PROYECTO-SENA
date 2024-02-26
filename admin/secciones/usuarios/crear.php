<?php 
include("../../bd.php");

if($_POST){
    // Recepcionamos los valores del formulario
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $rol = isset($_POST['rol']) ? $_POST['rol'] : "";
    $correo = isset($_POST['correo']) ? $_POST['correo'] : "";
   

    
  // Manejo de la imagen
  $foto_nombre = $_FILES['foto']['name']; // Obtener el nombre del archivo
  $foto_temporal = $_FILES['foto']['tmp_name']; // Obtener la ruta temporal del archivo
  $foto_extension = pathinfo($foto_nombre, PATHINFO_EXTENSION); // Obtener la extensión del archivo
  $foto_destino = "../../../assets/uploads/" . uniqid('foto_') . ".$foto_extension"; // Generar un nombre único para la foto
    
   // Mover la imagen del directorio temporal al directorio final
   move_uploaded_file($foto_temporal, $foto_destino);

 // Preparamos la consulta para insertar el nuevo usuario
       $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios` 
       (`usuario`, `password`, `rol`, `correo`, `foto`)
       VALUES(:usuario, :password, :rol, :correo, :foto)");

     // Asociamos los parámetros
     $sentencia->bindParam(":usuario", $usuario);
     $sentencia->bindParam(":password", $password);
     $sentencia->bindParam(":rol", $rol);
     $sentencia->bindParam(":correo", $correo);
     $sentencia->bindParam(":foto", $foto_destino);

   // Ejecutamos la consulta
   $sentencia->execute();

     // Redireccionamos a la página principal con un mensaje
     $mensaje = "Registro agregado con éxito.";
     header("Location:index.php?mensaje=" . $mensaje);
 }

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password" />
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-control" name="rol" id="rol">
                    <option value="Administrador">Administrador</option>
                    <option value="Vendedor">Vendedor</option>
                    <option value="Cliente">Cliente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto de perfil:</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/* required">
            </div>
            <button type="submit" class="btn btn-success">Agregar usuario</button> 
            <a href="index.php" class="btn btn-primary" role="button">Cancelar</a>  
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");?>
