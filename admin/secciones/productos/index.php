<?php  
include("../../bd.php");

$lista_portafolio = []; // Inicializamos la variable como un array vacío

// Seleccionar los registros almacenados en la BD sobre los servicios que se han creado.
$sentencia = $conexion->prepare("SELECT * FROM `tbl_productos` ");
$sentencia->execute();
$lista_portafolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);


if(isset($_GET['txtID']) && !empty($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    try {
        // Borrar el registro con el ID correspondiente
        $sentencia = $conexion->prepare("DELETE FROM `tbl_productos` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $mensaje = "Registro borrado correctamente!";
        header("Location:index.php?mensaje=" . $mensaje);
        exit();
    } catch (PDOException $e) {
        echo "Error al intentar eliminar el producto: " . $e->getMessage();
    }
}

include("../../templates/header_ventas.php");
?>

<div class="card-header">
    <a class="btn btn-secondary" href="http://localhost/website/admin/index.php?usuario=vendedor" role="button">VOLVER A SECCIÓN PRINCIPAL</a>           
</div> <br>

<div class="container">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th> 
                            <th scope="col">PRODUCTO</th>                           
                            <th scope="col">STOCK</th>                            
                            <th scope="col">IMAGEN</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CLIENTE & CATEGORIA</th>
                            <th scope="col">ACCIONES</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista_portafolio as $registros){ ?>
                            <tr>
                                <td scope="col"><?php echo $registros['ID']; ?></td>
                                <td scope="col"><?php echo $registros['titulo']; ?></td>
                                <td scope="col"><?php echo $registros['cantidad']; ?></td>
                                <td scope="col">
                                    <img width="80" src="../../../assets/img/portfolio/<?php echo $registros['imagen']; ?>"/>
                                </td>
                                <td scope="col"><?php echo $registros['descripcion']; ?></td>
                                <td scope="col"><?php echo isset($registros['precio']) ? $registros['precio'] : ''; ?></td>
                                <td scope="col"><?php echo $registros['categoria']; ?></td>
                                <td scope="col">
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button"><i class="fas fa-edit"></i> Editar</a>
                                        <button class="btn btn-danger eliminar-producto" data-id="<?php echo $registros['ID']; ?>"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Script para confirmar antes de eliminar un producto
    const botonesEliminar = document.querySelectorAll('.eliminar-producto');
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del botón
            
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    const idProducto = this.getAttribute('data-id');
                    // Redirigir a la misma página con el ID del producto a eliminar
                    window.location.href = `index.php?txtID=${idProducto}`;
                }
            });
        });
    });
</script>

<?php include("../../templates/footer.php");?>
