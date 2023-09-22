<?php
require_once "conexion.php";

$opcion = isset($_POST["opcion"]) ? $_POST["opcion"] : "";


$correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
$clave = isset($_POST["clave"]) ? $_POST["clave"] : "";
$permisos = isset($_POST["permisos"]) ? $_POST["permisos"] : "";
$nombre_usuario = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
$correo_usuario = isset($_POST["correo"]) ? $_POST["correo"] : "";
$clave_usuario = isset($_POST["clave"]) ? $_POST["clave"] : "";
$foto_usuario = isset($_POST["foto_usuario"]) ? $_POST["foto_usuario"] : "";
$telefono_usuario = isset($_POST["telefono"]) ? $_POST["telefono"] : "";



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
    $sql = "SELECT * FROM usuarios 
    WHERE (correo = '$correo' OR telefono = '$correo') 
    AND clave = '$clave'";
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
 ORDER BY actividades.ID_actividad DESC";


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
    INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario
    ORDER BY actividades.ID_actividad DESC";
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
    $sql = "INSERT INTO `actividades`(`ID_nombre_actividad`, `descripcionActividad`, `fecha_inicio`, `fecha_fin`, `estadoActividad`, `ID_usuario`) VALUES ('$ID_nombre_actividad','$descripcionActividad',null,null,'Pendiente','$ID_usuario')";
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
    } else  if ($nuevoEstado != null && $nuevoEstado == "Iniciado") {

        $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado', fecha_inicio=NOW() where ID_actividad=$ID_actividad";
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
            VALUES ('$nombreUnico', NOW(), $ID_usuario, $ID_actividad)";

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
} elseif ($opcion == "10") {
    // Opción 2: Obtener actividades del usuario
    $sql = "SELECT * FROM `fotos_actividades` WHERE ID_actividad=$ID_actividad";

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
            echo "No se encontraron evidencias";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "11") {
    // Opción 2: Obtener actividades del usuario
    $sql = "SELECT * FROM `nombre_actividades`";

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
} elseif ($opcion == "12") {
    // Opción 2: Obtener actividades del usuario
    $sql = "DELETE FROM nombre_actividades WHERE ID_nombre_actividad=$ID_nombre_actividad";

    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados en la consulta

        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "13") {
    // Opción 2: Obtener actividades del usuario
    $sql = "SELECT * FROM `usuarios`";

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
} elseif ($opcion == "14") {
    $correo_existente = false;
    $nombre_existente = false;
    $telefono_existente = false;

    // Verificar si el correo ya existe
    $sql_correo = "SELECT * FROM usuarios WHERE correo = '$correo_usuario'";
    $result_correo = $conexion->query($sql_correo);

    if ($result_correo->num_rows > 0) {
        $correo_existente = true;
    }

    // Verificar si el nombre ya existe
    $sql_nombre = "SELECT * FROM usuarios WHERE nombre = '$nombre_usuario'";
    $result_nombre = $conexion->query($sql_nombre);

    if ($result_nombre->num_rows > 0) {
        $nombre_existente = true;
    }

    // Verificar si el teléfono ya existe
    $sql_telefono = "SELECT * FROM usuarios WHERE telefono = '$telefono_usuario'";
    $result_telefono = $conexion->query($sql_telefono);

    if ($result_telefono->num_rows > 0) {
        $telefono_existente = true;
    }

    if ($correo_existente || $nombre_existente || $telefono_existente) {
        echo "Error: El correo, nombre o teléfono ya existen en la base de datos.";
    } else {
        // Continúa con la inserción
        $sql = "INSERT INTO `usuarios` (`permisos`, `nombre`, `correo`, `clave`, `telefono`) VALUES ('$permisos', '$nombre_usuario', '$correo_usuario', '$clave_usuario', '$telefono_usuario')";

        $result = $conexion->query($sql);

        if ($result) {
            echo "Éxito";
        } else {
            // Error en la consulta SQL
            echo "Error en la consulta: " . $conexion->error;
        }
    }
} elseif ($opcion == "15") {
    // Opción 2: Obtener actividades del usuario
    $sql = "UPDATE `usuarios` SET `permisos`='$permisos',`nombre`='$nombre_usuario',`correo`='$correo_usuario',`clave`='$clave_usuario',`telefono`='$telefono_usuario' WHERE ID_usuario=$ID_usuario";

    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados en la consulta

        echo "exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "16") {
    // Opción 2: Obtener actividades del usuario
    $sql = "DELETE FROM `usuarios` WHERE ID_usuario= $ID_usuario";

    $result = $conexion->query($sql);

    if ($result) {

        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "17") {
    // Opción 2: Obtener actividades del usuario
    $sql = "UPDATE actividades SET `ID_nombre_actividad`='$ID_nombre_actividad',`descripcionActividad`='$descripcionActividad' WHERE ID_actividad= $ID_actividad";

    $result = $conexion->query($sql);
    if ($result) {

        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "18") {
    // Opción 2: Obtener actividades del usuario
    $sql = "DELETE FROM `actividades` WHERE ID_actividad=$ID_actividad";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == "19") {
    // Opción 1: Autenticación
    $sql = "SELECT * FROM ubicacion_actividades WHERE ID_actividad= $ID_actividad";
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
} else if ($opcion == "25") {
  // Verificar si se ha enviado un archivo
if ($_FILES['imagen23']['error'] === UPLOAD_ERR_OK) {
    // Obtener información del archivo
    $nombreArchivoOriginal = $_FILES['imagen23']['name'];
    $tipoArchivo = $_FILES['imagen23']['type'];
    $tamañoArchivo = $_FILES['imagen23']['size'];
    $rutaTemporal = $_FILES['imagen23']['tmp_name'];

    // Generar el nombre de archivo
    $nombreArchivo = 'fotoperfilusuario' . $ID_usuario . '.jpg';

    // Definir la ruta donde se guardará la imagen
    $rutaDestino = 'fotos/fotos_usuarios/' . $nombreArchivo;

    // Crear la carpeta 'fotos/fotos_usuarios' si no existe
    if (!file_exists('fotos/fotos_usuarios')) {
        mkdir('fotos/fotos_usuarios', 0777, true);
    }

    // Mover la imagen de la ruta temporal a la ruta de destino con el nombre único
    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {

        $sql = "UPDATE `usuarios` SET foto_usuario= '$rutaDestino' WHERE ID_usuario= $ID_usuario";

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
