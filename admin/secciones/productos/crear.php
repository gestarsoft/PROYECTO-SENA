<?php 
include("../../bd.php");

// Obtener categorías de la base de datos
$categorias = [];
$sql = "SELECT * FROM tbl_categorias";
$resultado = $conexion->query($sql);
if ($resultado !== false && $resultado->rowCount() > 0) {
    while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $categorias[] = $row;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se está agregando una nueva categoría
    if(!empty($_POST['nueva_categoria'])) {
        $nueva_categoria = $_POST['nueva_categoria'];

        try {
            $stmt = $conexion->prepare("INSERT INTO `tbl_categorias` (`nombre`) VALUES (:nombre)");
            $stmt->bindParam(":nombre", $nueva_categoria);
            $stmt->execute();

            $mensaje = "Nueva categoría agregada correctamente.";
            header("Location: crear.php?mensaje=".$mensaje);
            exit();
        } catch (PDOException $e) {
            echo "Error al insertar nueva categoría: " . $e->getMessage();
        }
    }

    // Procesar el formulario de creación de productos
    if(!empty($_POST['titulo']) && !empty($_FILES["imagen"]["name"]) && !empty($_POST['descripcion']) && !empty($_POST['categoria']) && !empty($_POST['cantidad']) && !empty($_POST['precio'])) {
        $titulo = $_POST['titulo'];
        $imagen = $_FILES["imagen"]["name"];
        $descripcion = $_POST['descripcion'];
        $categoria_id = $_POST['categoria'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen;

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        if($tmp_imagen != ""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);
        }

        try {
            $sentencia = $conexion->prepare("INSERT INTO `tbl_productos` 
                (`ID`, `titulo`,`imagen`, `descripcion`, `categoria`, `cantidad`, `precio`)
                VALUES (NULL, :titulo, :imagen, :descripcion, :categoria, :cantidad, :precio)");
            $sentencia->bindParam(":titulo", $titulo);    
            $sentencia->bindParam(":imagen", $nombre_archivo_imagen);    
            $sentencia->bindParam(":descripcion", $descripcion);    
            $sentencia->bindParam(":categoria", $categoria_id);    
            $sentencia->bindParam(":cantidad", $cantidad);    
            $sentencia->bindParam(":precio", $precio);    
            $sentencia->execute();

            $mensaje = "Registro creado con éxito.";
            header("Location:index.php?mensaje=".$mensaje);
            exit(); 
        } catch (PDOException $e) {
            echo "Error al insertar producto: " . $e->getMessage();
        }
    }
}

include("../../templates/header.php");
?>

<!-- Formulario para agregar una nueva categoría -->
<div class="card">
    <div class="card-body">
        <h2>¿Desea agregar una nueva categoría?</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="nueva_categoria" class="form-label">Nombre de la nueva Categoría:</label>
                <input type="text" class="form-control" name="nueva_categoria" id="nueva_categoria" aria-describedby="helpId" placeholder="Ingresar el nombre" required />
            </div>
            <button type="submit" class="btn btn-primary">Agregar Categoría</button>
        </form>
    </div>
</div>

<!-- Formulario de creación de productos -->
<div class="card">
    <div class="card-header">
        Producto del portafolio
    </div>
    <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post"> 
            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre del Producto:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" required />
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio del Producto:</label>
                <input type="text" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="precio" required />
            </div>
            
            <div class="mb-3">
                <label for="imagen" class="form-label">Imágen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="" aria-describedby="fileHelpId" required />
                <div id="fileHelpId" class="form-text">Seleccionar imágen:</div>
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" required />
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <option value="">Seleccionar Categoría</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>  
            
            <div class="mb-3">
                <label for="cantidad" class="form-label">STOCK:</label>
                <input type="text" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Ingresa la cantidad" required />
            </div>
           
            <button type="submit" class="btn btn-success">Agregar</button> 
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">  Cancelar  </a>                     
        </form>
    </div>
</div>

<?php include("../../templates/footer.php");?>
