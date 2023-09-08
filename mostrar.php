<?php
require_once "conexion.php";

$opcion = $_POST["opcion"];
$correo = $_POST["correo"];
$clave = $_POST["clave"];
$nombreActividad = $_POST["nombreActividad"];
$descripcionActividad = $_POST["descripcionActividad"];

$nuevoEstado = $_POST["nuevoEstado"];
$ID_usuario = $_POST["ID_usuario"];
$ID_actividad = $_POST["ID_actividad"];
$longitud = $_POST["longitud"];
$latitud = $_POST["latitud"];
$nuevoNombreActividad = $_POST["nuevoNombreActividad"];
$ID_nombre_actividad = $_POST["ID_nombre_actividad"];

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
}elseif ($opcion == "9") {
    // Opción 9: Subir una imagen y guardar su información en la base de datos

    // Verificamos si se ha enviado un archivo
    if(isset($_FILES['archivo'])) {
        $nombreFoto = $_FILES['archivo']['name'];
        $fecha = date('Y-m-d H:i:s'); // Fecha actual

        // Ruta donde se guardarán los archivos (en la carpeta "fotos" en la raíz de tu proyecto)
        $ruta = '../fotos/' . $nombreFoto;


        // Mover el archivo cargado a la carpeta destino
        if(move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta)) {
            // La carga del archivo fue exitosa, ahora puedes realizar la inserción en la base de datos
            // Asegúrate de escapar los valores adecuadamente para prevenir inyecciones SQL
            $nombreFoto = $conexion->real_escape_string($nombreFoto);
            $sql = "INSERT INTO fotos_actividades(nombreFoto, fecha, ID_usuario, ID_actividad) 
                    VALUES ('$nombreFoto', '$fecha', $ID_usuario, $ID_actividad)";
            
            $result = $conexion->query($sql);

            if ($result) {
                echo "Éxito";
            } else {
                // Error en la consulta SQL
                echo "Error en la consulta: " . $conexion->error;
            }
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "No se ha enviado ningún archivo.";
    }
} else {
    // Opción no válida
    echo "Opción no válida";
}
// Cerrar la conexión a la base de datos
$conexion->close();
