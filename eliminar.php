<?php

// Obtener datos del formulario
    $id = $_POST["id"];

    // Preparar la consulta SQL
    $consulta = "DELETE FROM users WHERE ID=$id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param($marca, $modelo, $color, $kilometraje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Eliminado correctamente";
    } else {
        echo "No Eliminado";
    }

    ?>