<?php
require_once 'vendor/autoload.php'; // Cargar PHPUnit y extensiones necesarias
require_once 'crear_usuario.php'; // Incluir la clase crear_usuario

use PHPUnit\Framework\TestCase;

class PruebaCrearUsuario extends TestCase {
    public function testCrearUsuario() {
        // Simular el envío de un formulario con datos válidos
        $_POST['usuario'] = 'nuevo_usuario';
        $_POST['password'] = 'password123';
        $_POST['rol'] = 'Administrador';
        $_POST['correo'] = 'correo@example.com';

        // Instanciar la clase crear_usuario
        $creador = new crear_usuario();

        // Crear un nuevo usuario utilizando el método de la clase crear_usuario
        $usuarioCreado = $creador->crearNuevoUsuario($_POST['usuario'], $_POST['password'], $_POST['rol'], $_POST['correo']);

        // Asegurémonos de que se haya creado el usuario
        $this->assertNotNull($usuarioCreado, 'El usuario no se ha creado correctamente.');

        // Verifiquemos si los atributos del usuario coinciden con los datos proporcionados en el formulario
        $this->assertEquals('password123', $usuarioCreado['password'], 'La contraseña no coincide.');
        $this->assertEquals('Administrador', $usuarioCreado['rol'], 'El rol no coincide.');
        $this->assertEquals('correo@example.com', $usuarioCreado['correo'], 'El correo no coincide.');

        // Si lo deseas, puedes verificar otros aspectos, como la existencia de la foto de perfil del usuario en el sistema de archivos

        // Si lo deseas, puedes limpiar los datos creados durante la prueba
        // eliminarUsuarioPorNombre('nuevo_usuario');
    }
}

?>
