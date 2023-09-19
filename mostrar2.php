<?php
require_once "conexion.php";

$opcion = $_POST["opcion"];
if ($opcion == "9") {
    $nombreFoto = $_POST["nombreFoto"];
    $fotoImagen = $_POST["fotoImagen"];

    $path = "fotosDesdeGaleria/$nombreFoto"; // Cambia la ruta de destino aquí

    if (file_put_contents($path, base64_decode($fotoImagen))) {
        $actualPath = "http://localhost/Milton/BitacoraPHP/fotosDesdeGaleria/$path"; // Cambia la URL base según tu configuración
        $CONSULTA = "INSERT INTO `imagenes`(`nombre`, `ruta`, `descripcion`, `fecha_subida`) 
                     VALUES ('$nombreFoto','$actualPath','Prueba',now())";

        if (mysqli_query($conexion, $CONSULTA)) {
            echo "SE SUBIÓ EXITOSAMENTE";
        } else {
            echo "Error al insertar en la base de datos";
        }
    } else {
        echo "Error al guardar la imagen en el servidor";
    }
}
