<?php  
include("../../bd.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si todos los campos obligatorios están presentes y no están vacíos
    if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['rol']) && !empty($_POST['correo']) && !empty($_FILES['foto']['name'])) {
        // Recepcionamos los valores del formulario
        $usuario = $_POST['usuario'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña
        $rol = $_POST['rol'];
        $correo = $_POST['correo'];

        // Manejo de la imagen
        $foto_nombre = $_FILES['foto']['name'];
        $foto_temporal = $_FILES['foto']['tmp_name'];
        $foto_extension = pathinfo($foto_nombre, PATHINFO_EXTENSION);
        $foto_destino = "../../../assets/uploads/" . uniqid('foto_') . ".$foto_extension";
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
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password" required />
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-control" name="rol" id="rol" required>
                    <option value="Administrador">Administrador</option>
                    <option value="Vendedor">Vendedor</option>
                    <option value="Cliente">Cliente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" required />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto de perfil:</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success">Agregar usuario</button>
            <a href="index.php" class="btn btn-primary" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<script>
    function validateForm() {
        // Verificar si algún campo obligatorio está vacío
        var usuario = document.getElementById("usuario").value;
        var password = document.getElementById("password").value;
        var rol = document.getElementById("rol").value;
        var correo = document.getElementById("correo").value;
        var foto = document.getElementById("foto").value;

        if (usuario == "" || password == "" || rol == "" || correo == "" || foto == "") {
            alert("Todos los campos son obligatorios");
            return false;
        }
        return true;
    }
</script>

<?php include("../../templates/footer.php"); ?>
