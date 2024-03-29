<?php  
include("../../bd.php");

if(isset($_GET['txtID'])){
    // Recuperar los datos del ID correspondiente (seleccionado).
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT *  FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    // Almacenar datos en una variable llamada $registro.
    $registro=$sentencia->fetch(PDO::FETCH_ASSOC);

    $usuario=$registro['usuario'];
    $correo=$registro['correo'];
    $password=$registro['password'];
    $rol=$registro['rol'];
    $foto=$registro['foto']; // Obtener el nombre de la foto actual del usuario.
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Recepcionamos los valores del formulario.
    $ID=(isset($_POST['txtID']))?$_POST['txtID']: "";
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']: "";
    $password=(isset($_POST['password']))?$_POST['password']: "";
    $correo=(isset($_POST['correo']))?$_POST['correo']: "";
    $rol=(isset($_POST['rol']))?$_POST['rol']: "";

    // Verificar si todos los campos obligatorios están presentes y no están vacíos
    if(!empty($usuario) && !empty($password) && !empty($correo) && !empty($rol)) {
        // Procesar la imagen solo si se selecciona una nueva
        if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
            $foto_nombre = $_FILES['foto']['name']; // Obtener el nombre de la imagen
            $foto_temporal = $_FILES['foto']['tmp_name']; // Obtener la ruta temporal de la imagen
            $foto_extension = pathinfo($foto_nombre, PATHINFO_EXTENSION); // Obtener la extensión del archivo
            $foto_destino = "../../../assets/uploads/" . uniqid('foto_') . ".$foto_extension"; // Definir la ruta de destino para guardar la imagen
            // Mover la imagen del directorio temporal al definitivo
            move_uploaded_file($foto_temporal, $foto_destino);
        } else {
            // Si no se selecciona una nueva foto, mantener la foto actual
            $foto_destino = $foto;
        }

        $sentencia=$conexion->prepare("UPDATE tbl_usuarios 
            SET usuario=:usuario, password=:password, correo=:correo, rol=:rol, foto=:foto WHERE id=:id ");  

        $sentencia->bindParam(":usuario",$usuario);
        $sentencia->bindParam(":password",$password);
        $sentencia->bindParam(":correo",$correo); 
        $sentencia->bindParam(":rol",$rol);
        $sentencia->bindParam(":foto",$foto_destino); // Bind de la variable $foto_destino.
        $sentencia->bindParam(":id",$txtID); 
        $sentencia->execute();
        $mensaje="Registro modificado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);
        exit(); // Terminamos la ejecución del script después de redireccionar
    } else {
        // Mostrar alerta si algún campo obligatorio está vacío
        echo "<script>alert('Todos los campos son obligatorios');</script>";
    }
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
       Editar Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" readonly class="form-control"  value="<?php echo $txtID?>" name="txtID"  id="txtID" aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" value="<?php echo $usuario?>" name="usuario"id="usuario" aria-describedby="helpId" placeholder="Usuario" required />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" value="<?php echo $password?>" name="password"id="password" aria-describedby="helpId" placeholder="Password" required />
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo:</label>
                <input type="email" class="form-control"  value="<?php echo $correo?>"  name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" required />
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-control" id="rol" name="rol" required>
                    <option value="Administrador" <?php if($rol == 'Administrador') echo 'selected'; ?>>Administrador</option>
                    <option value="Vendedor" <?php if($rol == 'Vendedor') echo 'selected'; ?>>Vendedor</option>
                    <option value="Cliente" <?php if($rol == 'Cliente') echo 'selected'; ?>>Cliente</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto de perfil:</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                <?php if (!empty($foto)) : ?>
                    <img src="<?php echo $foto; ?>" alt="Foto de perfil actual" width="50">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success">Actualizar usuario</button> 
            <a name="" id=""  class="btn btn-primary"  href="index.php"  role="button">Cancelar</a>  
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<script>
    function validateForm() {
        // Verificar si algún campo obligatorio está vacío
        var usuario = document.getElementById("usuario").value;
        var password = document.getElementById("password").value;
        var correo = document.getElementById("correo").value;
        var rol = document.getElementById("rol").value;

        if (usuario == "" || password == "" || correo == "" || rol == "") {
            alert("Todos los campos son obligatorios");
            return false;
        }
        return true;
    }
</script>

<?php include("../../templates/footer.php");?>
