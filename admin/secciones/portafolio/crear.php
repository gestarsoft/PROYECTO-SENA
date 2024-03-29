<?php 
include("../../bd.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verificar si todos los campos obligatorios están presentes y no están vacíos
    if(!empty($_POST['titulo']) && !empty($_POST['subtitulo']) && !empty($_FILES["imagen"]["name"]) && !empty($_POST['descripcion']) && !empty($_POST['cliente']) && !empty($_POST['categoria']) && !empty($_POST['url'])) {
        //Recepcionamos los valores del formulario
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $imagen = $_FILES["imagen"]["name"];
        $descripcion = $_POST['descripcion'];
        $cliente = $_POST['cliente'];
        $categoria = $_POST['categoria'];
        $url = $_POST['url'];

        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        if($tmp_imagen != ""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);
        }

        $sentencia = $conexion->prepare("INSERT INTO `tbl_portafolio` 
            (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`)
            VALUES (NULL, :titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url)");

        $sentencia->bindParam(":titulo", $titulo);    
        $sentencia->bindParam(":subtitulo", $subtitulo);    
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);    
        $sentencia->bindParam(":descripcion", $descripcion);    
        $sentencia->bindParam(":cliente", $cliente);    
        $sentencia->bindParam(":categoria", $categoria);    
        $sentencia->bindParam(":url", $url);    

        $sentencia->execute();
        $mensaje = "Registro creado con éxito.";
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
        Producto del portafolio
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data"  method="post"> 
    <div class="mb-3">
    <label for="titulo" class="form-label">Título:</label>
    <input type="text"
         class="form-control" name="titulo"
         id="titulo"
         aria-describedby="helpId" 
         placeholder="Titulo" required />
    </div>
        

        <div class="mb-3">
            <label for="subtitulo" class="form-label">Subtítulo:</label>
            <input
                type="text"
                class="form-control"
                name="subtitulo"
                id="subtitulo"
                aria-describedby="helpId"
                placeholder="subtitulo" required />            
        </div>
        
        <div class="mb-3">
            <label for="imagen" class="form-label">Imágen:</label>
            <input
                type="file"
                class="form-control"
                name="imagen"
                id="imagen"
                placeholder=""
                aria-describedby="fileHelpId" required />
            <div id="fileHelpId" class="form-text">Seleccionar imágen:</div>
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input
                type="text"
                class="form-control"
                name="descripcion"
                id="descripcion"
                aria-describedby="helpId"
                placeholder="Descripcion" required />
            
        </div>
        
        <!-- <div class="mb-3">
            <label for="cliente" class="form-label">Cliente:</label>
            <input
                type="text"
                class="form-control"
                name="cliente"
                id="cliente"
                aria-describedby="helpId"
                placeholder="Cliente" required />
            
        </div>         -->
       
          
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria:</label>
            <input
                type="text"
                class="form-control"
                name="categoria"
                id="categoria"
                aria-describedby="helpId"
                placeholder="Categoria" required />
            
        </div>  
               
       
        <div class="mb-3">
            <!-- <label for="url" class="form-label">URL:</label>
            <input  type="text"   class="form-control"  name="url" id="url"   aria-describedby="helpId" placeholder="URL del proyecto" required /> -->
            <button type="submit"class="btn btn-success">Agregar</button> 
            <a name="" id=""  class="btn btn-primary"  href="index.php"  role="button">Cancelar</a>                     

    </form>

</div>
<div class="card-footer text muted">
</div>
</div>
<?php include("../../templates/footer.php");?>
