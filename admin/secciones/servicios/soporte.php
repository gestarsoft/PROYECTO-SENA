<?php 
include("../../bd.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos requeridos no estén vacíos
    if(!empty($_POST['nombre']) && !empty($_POST['celular']) && !empty($_POST['correo']) && !empty($_POST['titulo']) && !empty($_POST['descripcion']) && !empty($_POST['estado'])) {
        // Recepcionar los valores del formulario
        $nombre = $_POST['nombre'];
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
        
        // Generar número de ticket
        $numeroTicket = uniqid();

        try {
            // Insertar el nuevo ticket en la tabla
            $stmt = $conexion->prepare("INSERT INTO `tbl_tickets` 
                (`numero_ticket`, `nombre_cliente`, `celular_cliente`, `correo_cliente`, `titulo`, `descripcion`, `estado`) 
                VALUES (:numero_ticket, :nombre_cliente, :celular_cliente, :correo_cliente, :titulo, :descripcion, :estado)");
            $stmt->bindParam(":numero_ticket", $numeroTicket);
            $stmt->bindParam(":nombre_cliente", $nombre);
            $stmt->bindParam(":celular_cliente", $celular);
            $stmt->bindParam(":correo_cliente", $correo);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":estado", $estado);
            $stmt->execute();

            // Redireccionar a tickets.php
            header("Location: tickets.php");
            exit();
        } catch (PDOException $e) {
            echo "Error al crear el ticket: " . $e->getMessage();
        }
    } else {
        // Mostrar mensaje de error si algún campo está vacío
        echo "<script>alert('Por favor completa todos los campos');</script>";
    }
}

include("../../templates/header.php");
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            Crear Nuevo Ticket
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="row mb-3">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre del Cliente:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Cliente" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="celular" class="col-sm-2 col-form-label">Celular del Cliente:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular del Cliente" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="correo" class="col-sm-2 col-form-label">Correo del Cliente:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo del Cliente" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="titulo" class="col-sm-2 col-form-label">Título:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Descripción" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="estado" id="estado" required>
                            <option value="Abierto">Abierto</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Cerrado">Cerrado</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Crear Ticket</button> 
                <a name="" id="" class="btn btn-success" href="tickets.php" role="button">  Cancelar  </a> 
            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
