<?php 
include("../../bd.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verificar si todos los campos obligatorios están presentes y no están vacíos
    if(!empty($_POST['fecha']) && !empty($_POST['titulo']) && !empty($_POST['descripcion']) && !empty($_FILES["imagen"]["name"])) {
        //Recepcionamos los valores del formulario
        $fecha = $_POST['fecha'];
        $titulo = $_POST['titulo'];   
        $descripcion = $_POST['descripcion']; 
        $imagen = $_FILES["imagen"]["name"];
        
        //Moviliza la imágen a una nueva carpeta
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        if($tmp_imagen != ""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/about/" . $nombre_archivo_imagen);
        }

        $sentencia = $conexion->prepare("INSERT INTO `tbl_entradas` 
            (`ID`, `fecha`, `titulo`, `descripcion`, `imagen`)
            VALUES(NULL, :fecha, :titulo, :descripcion, :imagen);");

        $sentencia->bindParam(":fecha", $fecha);    
        $sentencia->bindParam(":titulo", $titulo); 
        $sentencia->bindParam(":descripcion", $descripcion);     
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->execute();

        $mensaje = "Registro agregado con éxito.";
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
        Entradas
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha" required/>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" required/>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" required/>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen" required/>
            </div>

            <button type="submit" class="btn btn-success">Agregar</button> 
            <a href="index.php" class="btn btn-primary" role="button">Cancelar</a>
        </form>  
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");?>
