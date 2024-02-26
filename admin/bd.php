<?php

$servidor="localhost";
$baseDeDatos="website";
$usuario="root";
$contrasenia="";
try{

    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
    // echo "Conectado a la BD ...";

}catch(Exception $error){
    echo $error->getMessage();
}
?>