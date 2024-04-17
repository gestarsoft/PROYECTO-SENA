<?php 
include("../../bd.php");

$titulo = "";
$subtitulo;
$cantidad = "";
$imagen = "";
$descripcion = "";
$precio = "";
$categoria = "";
$url = "";

// Obtener el listado de categorías
$consulta_categorias = $conexion->prepare("SELECT * FROM tbl_categorias");
$consulta_categorias->execute();
$categorias = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_productos` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    
    $titulo = $registro['titulo'];
    $cantidad = $registro['cantidad'];
    $cantidad = $registro['cantidad'];
    $imagen = $registro['imagen'];
    $descripcion = $registro['descripcion'];
    $precio = $registro['precio'];
    $categoria = $registro['categoria'];
    $url = $registro['url'];
}

if($_POST){  

    // Recepcionamos los valores del formulario
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $cantidad_actualizada = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $precio = (isset($_POST['precio'])) ? $_POST['precio'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";
    $url = (isset($_POST['url'])) ? $_POST['url'] : "";

    // Actualizar la imagen si se agregó una nueva
    if($_FILES["imagen"]["tmp_name"] != ""){
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";    
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];   
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);

        // Borrar la imagen anterior
        $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_portafolio` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_imagen["imagen"])){        
            if(file_exists("../../../assets/img/portfolio/" . $registro_imagen["imagen"])){            
                unlink("../../../assets/img/portfolio/" . $registro_imagen["imagen"]);
            }       
        }    

        // Actualizar con la nueva imagen
        $sentencia = $conexion->prepare("UPDATE tbl_productos SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    $sentencia = $conexion->prepare("UPDATE tbl_productos SET cantidad=:cantidad, titulo=:titulo, descripcion=:descripcion, precio=:precio, categoria=:categoria, url=:url WHERE id=:id "); 

    $sentencia->bindParam(":cantidad", $cantidad_actualizada);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion); 
    $sentencia->bindParam(":precio", $precio); 
    $sentencia->bindParam(":categoria", $categoria); 
    $sentencia->bindParam(":url", $url); 
    $sentencia->bindParam(":id", $txtID); 
    $sentencia->execute();

    $mensaje = "Registro modificado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">Producto del portafolio</div>
        <div class="card-body">
            <form action="" enctype="multipart/form-data"  method="post"> 
                <div class="mb-3">
                    <label for="" class="form-label">ID</label>
                    <input readonly type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID;?>" aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="titulo" class="form-label">titulo:</label>
                    <input type="text" class="form-control" value="<?php echo $titulo;?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo"/>
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">cantidad:</label>
                    <input type="text" class="form-control" value="<?php echo $cantidad;?>" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="cantidad"/>
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">Imágen:</label>
                    <img width="60" src="../../../assets/img/portfolio/<?php echo $imagen; ?>"/>
                    <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId"/>            
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" value="<?php echo $descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción"/>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">PRECIO:</label>
                    <input type="text" class="form-control" value="<?php echo $precio;?>" name="precio" id="precio" aria-describedby="helpId" placeholder="precio del producto"/>
                </div>        
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select class="form-control" name="categoria" id="categoria">
                        <?php foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat['nombre']; ?>" <?php if($categoria == $cat['nombre']) echo 'selected'; ?>><?php echo $cat['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>        
                
                <button type="submit" class="btn btn-success">Actualizar</button> 
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>                     
            </form>
        </div>
        <div class="card-footer text muted"></div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
