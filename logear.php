<?php


require_once "conexion.php";

$celular=$_POST["telefono"];
$password=$_POST["password"];


$consulta= "SELECT * FROM login WHERE telefono='$celular' AND password='$password' LIMIT 1";
$result= mysqli_query($conexion, $consulta);

if($result->num_rows>0){
    $fila = $result->fetch_assoc();
    
    $nombre = $fila["nombre"];

echo  "".$nombre;
}else{
    echo "No hay coincidencias";
}


?>