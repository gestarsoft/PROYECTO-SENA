<?php 
include("../../bd.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){  
    //Aqui se recepcionan los valores del formulario para crear servicios.
    $icono = isset($_POST['icono']) ? $_POST['icono'] : "";
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";

    // Verificar si todos los campos obligatorios están presentes y no están vacíos
    if(!empty($icono) && !empty($titulo) && !empty($descripcion)) {
        $sentencia = $conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `icono`, `titulo`, `descripcion`) 
            VALUES (NULL, :icono, :titulo, :descripcion)");

        $sentencia->bindParam(":icono", $icono);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion); 

        $sentencia->execute();
        $mensaje = "Registro creado con éxito.";
        header("Location:index.php?mensaje=" . $mensaje);
        exit();
    } else {
        // Mostrar alerta si algún campo obligatorio está vacío
        echo "<script>alert('Todos los campos son obligatorios');</script>";
    }
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">Crear Servicios</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="icono" class="form-label">Icono:</label>
                <input type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" required /> 
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" required />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" required />
            </div>
            
            <button type="submit" class="btn btn-success">Agregar</button> 
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>        
        </form>
    </div>
</div>

<?php  include("../../templates/footer.php");?>
