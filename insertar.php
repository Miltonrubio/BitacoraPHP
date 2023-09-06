<?php

// Obtener datos del formulario
    $color = $_POST["color"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $kilometraje = $_POST["kilometraje"];

    // Preparar la consulta SQL
    $consulta = "INSERT INTO coches (marca, modelo, color, kilometraje)  VALUES (?, ?, ?,?)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param($marca, $modelo, $color, $kilometraje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos insertados correctamente en la base de datos.";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    ?>