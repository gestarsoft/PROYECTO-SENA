<?php
// tests/SeguridadInicioSesionTest.php

use PHPUnit\Framework\TestCase;

class SeguridadInicioSesionTest extends TestCase {
    
    protected $conexion;

    protected function setUp(): void {
        parent::setUp();
        
        // Incluir el archivo bd.php para obtener acceso a la conexión a la base de datos
        include("admin/bd.php");
        
        // Establecer la conexión a la base de datos
        $this->conexion = $GLOBALS['conexion'];
    
        // Verificar si $this->conexion se estableció correctamente
        var_dump($this->conexion);
    }
    

    public function testInyeccionSQL() {
        // Inyección de SQL maliciosa
        $_POST['usuario'] = "' OR 1=1--";
        $_POST['password'] = "' OR 1=1--";

        // Verificar si la conexión a la base de datos y la consulta preparada están protegiendo contra la inyección de SQL
        $sentencia = $this->conexion->prepare("SELECT *, count(*) as n_usuario 
                                              FROM `tbl_usuarios`
                                              WHERE usuario = :usuario
                                              AND password = :password");

        $sentencia->bindParam(":usuario", $_POST['usuario']);    
        $sentencia->bindParam(":password", $_POST['password']);

        $sentencia->execute();
        $lista_usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

        // Verificar que no se haya devuelto ningún usuario
        $this->assertEquals(0, $lista_usuarios['n_usuario'], "La prueba de inyección de SQL ha tenido éxito. Se han evitado los intentos de inicio de sesión maliciosos.");
        
        // Imprimir mensaje en la consola
        echo "La prueba de inyección de SQL ha tenido éxito. Se han evitado los intentos de inicio de sesión maliciosos.\n";
    }
}
?>
