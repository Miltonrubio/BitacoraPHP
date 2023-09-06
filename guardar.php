<?php
require_once "conexion.php";

// Obtener el token del formulario
$token = $_POST["Token"];
$email = $_POST["Email"];
$password = $_POST["Password"];

// Verificar si el token ya existe en la base de datos
$consulta_verificacion = "SELECT COUNT(*) as count FROM notificaciones WHERE Token = ?";
$stmt_verificacion = $conexion->prepare($consulta_verificacion);
$stmt_verificacion->bind_param("s", $token);
$stmt_verificacion->execute();
$resultado_verificacion = $stmt_verificacion->get_result();

if ($resultado_verificacion) {
    $fila = $resultado_verificacion->fetch_assoc();
    $token_existente = $fila["count"];

    if ($token_existente > 0) {
        echo "Token ya existe en la base de datos.";
    } else {
        // Preparar la consulta SQL para la inserción
        $consulta_insercion = "UPDATE notificaciones SET token = ? WHERE email = ? AND password = ?";
        $stmt_insercion = $conexion->prepare($consulta_insercion);
        $stmt_insercion->bind_param("sss", $token, $email, $password);

        if ($stmt_insercion->execute()) {
            echo "Token insertado exitosamente.";
        } else {
            echo "Error al insertar el token: " . $stmt_insercion->error;
        }
    }
} else {
    echo "Error al verificar el token existente: " . $conexion->error;
}

// Cerrar las declaraciones preparadas y la conexión a la base de datos
$stmt_verificacion->close();
$stmt_insercion->close();
$conexion->close();
?>
