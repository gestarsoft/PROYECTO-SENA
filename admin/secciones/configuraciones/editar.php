<?php 
include("../../bd.php");


if(isset($_GET['txtID'])){
            //Recuperar  los datos del ID correcpondiente (seleccionado.)
        $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
        $sentencia=$conexion->prepare("SELECT *  FROM `tbl_configuraciones` WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);


        $nombreconfiguracion=$registro['nombreconfiguracion'];
        $valor=$registro['valor'];
}
if($_POST){  
   
    //Aqui se recepcionan los valores del formulario para crear servicios.
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']: "";
    $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']: "";
    $valor=(isset($_POST['valor']))?$_POST['valor']: "";


   $sentencia=$conexion->prepare("UPDATE `tbl_configuraciones` 
   SET nombreconfiguracion=:nombreconfiguracion,valor=:valor WHERE id=:id;");    
  
   $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
   $sentencia->bindParam(":valor",$valor); 
   $sentencia->bindParam(":id",$txtID); 
   $sentencia->execute();
   
   $mensaje="Registro modificado con éxito.";
   header("Location:index.php?mensaje=".$mensaje);
}





include("../../templates/header.php");?>
🔂
 <div class="card">
    <div class="card-header">Panel de control  ⚙/  Configuración:</div>
    <div class="card-body">
        <form action="" method="post">

        <div class="mb-3">
                <label for="" class="form-label"> ID:</label>
                <input
                    readonly
                    type="text"
                    class="form-control"
                    value="<?php echo $txtID;?>"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder="" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nombre Configuración:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $nombreconfiguracion;?>"
                    name="nombreconfiguracion"
                    id="nombreconfiguracion"
                    aria-describedby="helpId"
                    placeholder=" Nombre de la Configuración" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Valor:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $valor;?>"
                    name="valor"
                    id="valor"
                    aria-describedby="helpId"
                    placeholder="Valor" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button> 
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php  include("../../templates/footer.php");?>