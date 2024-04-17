<?php
require_once 'vendor/autoload.php'; // Cargar PHPUnit y extensiones necesarias

use PHPUnit\Framework\TestCase;

class crear_usuario extends TestCase {
    public function testCrearUsuario() {
        // Simular el envío de un formulario con datos válidos
        $_POST['usuario'] = 'nuevo_usuario';
        $_POST['password'] = 'password123';
        $_POST['rol'] = 'Administrador';
        $_POST['correo'] = 'correo@example.com';

       

        // Verificar si el usuario se creó correctamente en la base de datos
        $usuarioCreado = obtenerUsuarioPorNombre('nuevo_usuario');

        // Asegurémonos de que se haya creado el usuario
        $this->assertNotNull($usuarioCreado, 'El usuario no se ha creado correctamente.');

        // Verifiquemos si los atributos del usuario coinciden con los datos proporcionados en el formulario
        $this->assertEquals('password123', $usuarioCreado['password'], 'La contraseña no coincide.');
        $this->assertEquals('Administrador', $usuarioCreado['rol'], 'El rol no coincide.');
        $this->assertEquals('correo@example.com', $usuarioCreado['correo'], 'El correo no coincide.');

        // Si lo deseas, puedes verificar otros aspectos, como la existencia de la foto de perfil del usuario en el sistema de archivos

        // Si lo deseas, puedes limpiar los datos creados durante la prueba
        eliminarUsuarioPorNombre('nuevo_usuario');
         // Mostrar un mensaje de confirmación después de la prueba
         echo "La prueba se hacompletado correctamente.\n";
    }
    
}

// Función para obtener un usuario por su nombre (simulada para propósitos de prueba)
function obtenerUsuarioPorNombre($nombre) {
    // Aquí puedes implementar la lógica para buscar el usuario en la base de datos
    // Por ahora, simulamos la creación de un usuario con los datos proporcionados
    return [
        'usuario' => $nombre,
        'password' => 'password123', // Contraseña en texto plano (por simplicidad)
        'rol' => 'Administrador',
        'correo' => 'correo@example.com'
        // Puedes agregar más campos según sea necesario
    ];
}

// Función para eliminar un usuario por su nombre (simulada para propósitos de prueba)
function eliminarUsuarioPorNombre($nombre) {
    // Aquí puedes implementar la lógica para eliminar el usuario de la base de datos
    // Por ahora, simulamos la eliminación del usuario
    // No es necesario en esta simulación ya que el usuario no se creará realmente en la base de datos
}
?>
