<?php
require_once "conexion.php";

    $opcion = $_POST["opcion"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $ID_usuario = $_POST["ID_usuario"];
    
    // Verificar la conexión a la base de datos
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    
    if ($opcion == "1") {
        // Opción 1: Autenticación
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
        $result = $conexion->query($sql);
        
        if ($result) {
            // Verificar si se encontraron resultados en la consulta
            if ($result->num_rows > 0) {
                // El usuario y la contraseña son válidos
                $response = array();
                while ($row = $result->fetch_assoc()) {
                    $response[] = $row;
                }
                echo json_encode($response);
            } else {
                // Las credenciales son incorrectas
                echo "fallo";
            }
        } else {
            // Error en la consulta SQL
            echo "Error en la consulta: " . $conexion->error;
        }
    } elseif ($opcion == "2") {
        // Opción 2: Obtener actividades del usuario
        $sql = "SELECT * FROM actividades AS a INNER JOIN usuarios AS u ON a.ID_usuario = u.ID_usuario WHERE u.ID_usuario = $ID_usuario ORDER BY a.fecha_inicio DESC";
        $result = $conexion->query($sql);
        
        if ($result) {
            // Verificar si se encontraron resultados en la consulta
            if ($result->num_rows > 0) {
                // Las actividades fueron encontradas
                $response = array();
                while ($row = $result->fetch_assoc()) {
                    $response[] = $row;
                }
                echo json_encode($response);
            } else {
                // No se encontraron actividades para el usuario
                echo "No se encontraron actividades";
            }
        } else {
            // Error en la consulta SQL
            echo "Error en la consulta: " . $conexion->error;
        }
    } else {
        // Opción no válida
        echo "Opción no válida";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();

?>
