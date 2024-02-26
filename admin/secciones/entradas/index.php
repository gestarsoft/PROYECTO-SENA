<?php 
include("../../bd.php");

//Borrando registros con el ID en las entradas del blog.
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT imagen  FROM `tbl_entradas` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){

        if(file_exists("../../../assets/img/about/".$registro_imagen["imagen"])){
            
            unlink("../../../assets/img/about/".$registro_imagen["imagen"]);

        }
       
    }



    $sentencia=$conexion->prepare("DELETE  FROM `tbl_entradas` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Registro borrado correctamente!";
    header("Location:index.php?mensaje=".$mensaje);

}

//seleccionar los registros 
$sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas` ");
$sentencia-> execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php"role="button">Agregar Registros</a>
    </div>
    <div class="card-body">

    <div
        class="table-responsive-sm"
    >
        <table
            class="table"
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Imágen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_entradas as $registros){?>

                <tr class="">
                <td><?php echo $registros['ID'];?></td>
                    <td><?php echo $registros['fecha'];?></td>
                    <td><?php echo $registros['titulo'];?></td>
                    <td><?php echo $registros['descripcion'];?></td>
                    <td><img  width="80" src="../../../assets/img/about/<?php echo $registros['imagen']; ?>"/></td>
                    <td scope="col"><a name="" id=""class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'] ?>"role="button"                 >Editar</a
                    >|<a name=""  id=""  class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID'] ?>" role="button" >Eliminar</a
                    >
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>





<?php  include("../../templates/footer.php");?>