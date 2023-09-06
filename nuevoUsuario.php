<?php


require_once "conexion.php";


$nombre=$_POST["nombre"];
$celular=$_POST["telefono"];
$password=$_POST["password"];


$consulta= "INSERT INTO login (`nombre`, `telefono`, `password`) VALUES ('$nombre','$celular','$password')";
$result= mysqli_query($conexion, $consulta);

// Ejecutar la consulta
if ($result) {
    echo "Registrado correctamente";
} else {
    echo "No Insertado";
}


?>