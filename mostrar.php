<?php
require_once "conexion.php";

$opcion = isset($_POST["opcion"]) ? $_POST["opcion"] : "";
$correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
$clave = isset($_POST["clave"]) ? $_POST["clave"] : "";
$nombreActividad = isset($_POST["nombreActividad"]) ? $_POST["nombreActividad"] : "";
$descripcionActividad = isset($_POST["descripcionActividad"]) ? $_POST["descripcionActividad"] : "";

$nuevoEstado = isset($_POST["nuevoEstado"]) ? $_POST["nuevoEstado"] : "";
$ID_usuario = isset($_POST["ID_usuario"]) ? $_POST["ID_usuario"] : "";
$ID_actividad = isset($_POST["ID_actividad"]) ? $_POST["ID_actividad"] : "";
$longitud = isset($_POST["longitud"]) ? $_POST["longitud"] : "";
$latitud = isset($_POST["latitud"]) ? $_POST["latitud"] : "";
$nuevoNombreActividad = isset($_POST["nuevoNombreActividad"]) ? $_POST["nuevoNombreActividad"] : "";
$ID_nombre_actividad = isset($_POST["ID_nombre_actividad"]) ? $_POST["ID_nombre_actividad"] : "";

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
    $sql = "SELECT *
        FROM actividades
        INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
        INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario
        WHERE actividades.ID_usuario = $ID_usuario
        ORDER BY actividades.fecha_inicio DESC;
        ";
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
} elseif ($opcion == "3") {
    // Opción 2: Obtener actividades del usuario
    $sql = "SELECT *
        FROM actividades
        INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
        ORDER BY actividades.fecha_inicio DESC";
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
} elseif ($opcion == "4") {
    // Opción 2: Obtener actividades del usuario
    $sql = "INSERT INTO `actividades`(`nombreActividad`, `descripcionActividad`, `fecha_inicio`, `fecha_fin`, `estadoActividad`, `ID_usuario`) VALUES ('$nombreActividad','$descripcionActividad',NOW(),null,'Pendiente','$ID_usuario')";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "5") {
    // Opción 2: Obtener actividades del usuario

    if ($nuevoEstado != null && $nuevoEstado == "Finalizado") {

        $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado', fecha_fin=NOW() where ID_actividad=$ID_actividad";
    } else {

        $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado' where ID_actividad=$ID_actividad";
    }
    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "6") {
    // Opción 2: Obtener actividades del usuario


    $sql = "INSERT INTO `nombre_actividades`(`nombre_actividad`) VALUES ('$nuevoNombreActividad')";

    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "7") {
    // Opción 2: Obtener actividades del usuario


    $sql = "UPDATE nombre_actividades SET nombre_actividad='$nuevoNombreActividad' WHERE ID_nombre_actividad=$ID_nombre_actividad ";

    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "8") {
    // Opción 2: Obtener actividades del usuario


    $sql = "INSERT INTO `ubicacion_actividades`(`nombreUbicacion`, `fecha_actividad`, `ID_usuario`, `ID_actividad`, `longitud_actividad`, `latitud_actividad`) VALUES ('Ubicacion de: ',NOW(),$ID_usuario,$ID_actividad, $longitud,$latitud)";

    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }

} elseif ($opcion == "9") {
    // Verificar si se ha enviado un archivo
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Obtener información del archivo
        $nombreArchivoOriginal = $_FILES['imagen']['name'];
        $tipoArchivo = $_FILES['imagen']['type'];
        $tamañoArchivo = $_FILES['imagen']['size'];
        $rutaTemporal = $_FILES['imagen']['tmp_name'];

        // Generar un nombre de archivo único
        $nombreUnico = uniqid() . '_' . $nombreArchivoOriginal;

        // Definir la ruta donde se guardará la imagen
        $rutaDestino = 'fotos/' . $nombreUnico;

        // Crear la carpeta 'fotos' si no existe
        if (!file_exists('fotos')) {
            mkdir('fotos', 0777, true);
        }

        // Mover la imagen de la ruta temporal a la ruta de destino con el nombre único
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            

            $sql = "INSERT INTO fotos_actividades (nombreFoto, fecha, ID_usuario, ID_actividad) 
VALUES ('$nombreUnico', NOW(), $ID_usuario, '$ID_actividad')";

            if ($conexion->query($sql) === TRUE) {
                echo "La imagen se ha subido y los datos se han registrado correctamente en la base de datos.";
            } else {
                echo "Error al registrar la imagen en la base de datos: " . $conexion->error;
            }
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    } else {
        echo "Error al cargar la imagen.";
    }
} else {
    // Opción no válida
    echo "Opción no válida";
}
// Cerrar la conexión a la base de datos
$conexion->close();