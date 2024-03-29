<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Recuperar los datos del ID correspondiente seleccionado
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    // Almacenar datos en una variable llamada $registro.
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    $icono = $registro['icono'];
    $titulo = $registro['titulo'];
    $descripcion = $registro['descripcion'];
}

if($_POST){
    // Recepcionamos los valores del formulario.
    $ID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $icono = (isset($_POST['icono'])) ? $_POST['icono'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    $sentencia = $conexion->prepare("UPDATE tbl_servicios 
                                     SET icono=:icono,
                                         titulo=:titulo,
                                         descripcion=:descripcion
                                     WHERE id=:id ");  
   
    $sentencia->bindParam(":icono", $icono);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion); 
    $sentencia->bindParam(":id", $txtID); 
    $sentencia->execute();
    $mensaje = "Registro modificado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">Editando la información de Servicios</div>
        <div class="card-body"></div>

        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input readonly value="<?php echo $txtID;?>" type="text" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />
            </div>

            <div class="mb-3">
                <label for="icono" class="form-label">Icono:</label>
                <input value="<?php echo $icono;?>" type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" /> 
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input value="<?php echo $titulo;?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input value="<?php echo $descripcion;?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" />
            </div>
            
            <button type="submit" class="btn btn-success">Actualizar</button> 
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>        
        </form>
    </div>
</div>

<?php include("../../templates/footer.php");?>
