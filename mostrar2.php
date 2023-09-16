<?php

require_once "conexion.php";

$opcion=$_POST["opcion"];
if($opcion=="9"){
    $nombreFoto=$_POST["nombreFoto"];
   $fotoImagen=$_POST["fotoImagen"];

   
$path= "fotosDesdeGaleria/$fotoImagen";


$actualPath="http://localhost/android/$path";

   
$CONSULTA="INSERT INTO `imagenes`(`nombre`, `ruta`, `descripcion`, `fecha_subida`) 
VALUES ('$nombreFoto','$actualPath','Prueba',now())";

if(mysqli_query($conexion, $CONSULTA)){
 
   
    file_put_contents($path, base64_decode($fotoImagen));
    echo "SE SUBIO EXITOSAMENTE";
    mysqli_close($conexion);
}else{
    echo "Erorr";
}

}

// Cerrar la conexión a la base de datos
$conexion->close();


