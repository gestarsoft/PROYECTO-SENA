<?php
include("../../bd.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    // Preparar la consulta utilizando consultas preparadas
    $sql = "INSERT INTO tbl_clientes (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)";
    
    try {
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$nombre, $apellido, $email, $telefono, $direccion]);
        
        // Redirigir a index.php
        header("Location: index.php");
        exit(); // Terminar la ejecución del script después de la redirección
    } catch(PDOException $e) {
        // Mostrar SweetAlert de error
        echo "<script>
            Swal.fire({
                title: 'Error al crear cliente',
                text: '{$e->getMessage()}',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';  // Redirigir a index.php
                }
            });
        </script>";
    }
}
?>
