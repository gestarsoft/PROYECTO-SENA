<?php
session_start();

include("./bd.php");

if($_POST){

    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $rolSeleccionado = isset($_POST['rol']) ? $_POST['rol'] : "";

    //seleccionar registros.
    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario 
                                    FROM `tbl_usuarios`
                                    WHERE usuario = :usuario
                                    AND password = :password");

    $sentencia->bindParam(":usuario", $usuario);    
    $sentencia->bindParam(":password", $password);

    $sentencia->execute();
    $lista_usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

    if($lista_usuarios['n_usuario'] > 0){  
        // Usuario y contraseña correctos.
        // Obtener el rol del usuario.
        $rolUsuario = $lista_usuarios['rol'];
        // Comprobar si el rol seleccionado coincide con el rol del usuario.
        if ($rolSeleccionado === $rolUsuario) { 
            $_SESSION['usuario'] = $lista_usuarios['usuario'];
            $_SESSION['logueado'] = true;
            $_SESSION['rol'] = $rolUsuario; // Almacena el rol en la sesión
            header("Location: index.php?usuario=" . urlencode($_SESSION['usuario']));
            exit();
        } else {
            $mensaje = "Error: El rol seleccionado no corresponde al rol del usuario.";
        }
    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        /* Agregar estilos CSS personalizados para dispositivos móviles */
        body {
            padding-top: 20px; /* Espacio superior para evitar la barra de navegación en dispositivos móviles */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Login</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingresa tu usuario" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Ingresa tu contraseña" />
                            </div>
                            <div class="mb-3">
                                <label for="rol" class="form-label">Rol:</label>
                                <select class="form-control" name="rol" id="rol">
                                    <option value="Administrador">Administrador</option>
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                            </div>
                            <?php if(isset($mensaje)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Enlace para ir a la página principal de la tienda -->
        <div class="text-center mt-3">
            <a href="http://localhost/website/" class="btn btn-primary">Ir a la página principal de la tienda tecnológica</a>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
