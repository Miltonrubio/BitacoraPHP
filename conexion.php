<?php 


$conexion = new mysqli("localhost", "root", "", "bitacora");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }else{
    }



?>