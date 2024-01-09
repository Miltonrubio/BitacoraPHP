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



$tipo_actividad = isset($_POST["tipo_actividad"]) ? $_POST["tipo_actividad"] : "";

$nombreActividad = isset($_POST["nombreActividad"]) ? $_POST["nombreActividad"] : "";
$descripcionActividad = isset($_POST["descripcionActividad"]) ? $_POST["descripcionActividad"] : "";

$nuevoEstado = isset($_POST["nuevoEstado"]) ? $_POST["nuevoEstado"] : "";
$ID_usuario = isset($_POST["ID_usuario"]) ? $_POST["ID_usuario"] : "";
$ID_actividad = isset($_POST["ID_actividad"]) ? $_POST["ID_actividad"] : "";
$longitud = isset($_POST["longitud"]) ? $_POST["longitud"] : "";
$latitud = isset($_POST["latitud"]) ? $_POST["latitud"] : "";
$nuevoNombreActividad = isset($_POST["nuevoNombreActividad"]) ? $_POST["nuevoNombreActividad"] : "";
$ID_nombre_actividad = isset($_POST["ID_nombre_actividad"]) ? $_POST["ID_nombre_actividad"] : "";

$motivocancelacion = isset($_POST["motivocancelacion"]) ? $_POST["motivocancelacion"] : "";

$saldo_asignado = isset($_POST["saldo_asignado"]) ? $_POST["saldo_asignado"] : "";

$TokenFIREBASE = isset($_POST["TokenFIREBASE"]) ? $_POST["TokenFIREBASE"] : "";
$TituloMensaje = isset($_POST["TituloMensaje"]) ? $_POST["TituloMensaje"] : "";
$CuerpoMensaje = isset($_POST["CuerpoMensaje"]) ? $_POST["CuerpoMensaje"] : "";


$nuevoTipoActividad = isset($_POST["nuevoTipoActividad"]) ? $_POST["nuevoTipoActividad"] : "";



$total_gastado = isset($_POST["total_gastado"]) ? $_POST["total_gastado"] : "";

$ID_saldo = isset($_POST["ID_saldo"]) ? $_POST["ID_saldo"] : "";

$nuevoSaldo = isset($_POST["nuevoSaldo"]) ? $_POST["nuevoSaldo"] : "";


$deposito = isset($_POST["deposito"]) ? $_POST["deposito"] : "";
$rango = isset($_POST["rango"]) ? $_POST["rango"] : "";
$NuevaCaja = isset($_POST["NuevaCaja"]) ? $_POST["NuevaCaja"] : "";




$serverKey = 'AAAAw189fFA:APA91bGcuc07qIZOK9pMiJt_pa-VBBi0sskU9vU3DRohluo2Jd1N2v0-eZdBtWvyqD-CuXBSEAm-n7nDQilh5v6GgiOfdD_Bd-HUGBUcluf9ChvdcfSrzyuiWZu6I-BMxfOcRMJkMVPQ';



$fechaInicio = isset($_POST["fechaInicio"]) ? $_POST["fechaInicio"] : "";
$fechaFin = isset($_POST["fechaFin"]) ? $_POST["fechaFin"] : "";
$tipo_caja = isset($_POST["tipo_caja"]) ? $_POST["tipo_caja"] : "";



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

    $sql = "SELECT * FROM actividades INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario WHERE actividades.ID_usuario = $ID_usuario ORDER BY COALESCE(actividades.fecha_inicio, '9999-12-31') DESC, actividades.fecha_inicio DESC";

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
    $sql = "INSERT INTO `actividades`(`ID_nombre_actividad`, `descripcionActividad`, `fecha_inicio`, `fecha_fin`, `estadoActividad`, `ID_usuario`) VALUES ('$ID_nombre_actividad','$descripcionActividad',null,null,'Pendiente','$ID_usuario')";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Extio";
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "5") {
    // Opción 2: Obtener actividades del usuario

    if ($nuevoEstado != null && $nuevoEstado == "Finalizado") {
        $fechaFin = date("Y-m-d H:i:s"); // Resta una hora a la fecha actual
        $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado', fecha_fin='$fechaFin', motivocancelacion='Todo correcto' WHERE ID_actividad=$ID_actividad";
    } else if ($nuevoEstado != null && $nuevoEstado == "Iniciado") {
        $fechaInicio = date("Y-m-d H:i:s"); // Resta una hora a la fecha actual
        $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado', fecha_inicio='$fechaInicio', motivocancelacion='Todo correcto' WHERE ID_actividad=$ID_actividad";
    } else {
        $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado' WHERE ID_actividad=$ID_actividad";
    }

    $result = $conexion->query($sql);

    if ($result) {
        echo "Éxito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "29") {
    $fechaFin = date("Y-m-d H:i:s"); // Resta una hora a la fecha actual

    $sql = "UPDATE actividades SET estadoActividad='$nuevoEstado', motivocancelacion='$motivocancelacion', fecha_fin='$fechaFin' WHERE ID_actividad=$ID_actividad";

    $result = $conexion->query($sql);

    if ($result) {
        echo "Éxito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "6") {
    // Opción 2: Obtener actividades del usuario


    $sql = "INSERT INTO `nombre_actividades`(`nombre_actividad`, `tipo_actividad`) VALUES ('$nuevoNombreActividad', '$tipo_actividad')";

    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "7") {
    // Opción 2: Obtener actividades del usuario


    $sql = "UPDATE nombre_actividades SET nombre_actividad='$nuevoNombreActividad', tipo_actividad='$nuevoTipoActividad' WHERE ID_nombre_actividad=$ID_nombre_actividad ";

    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "8") {
    // Opción 2: Obtener actividades del usuario

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $fecha_y_hora_actual = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `ubicacion_actividades`(`nombreUbicacion`, `fecha_actividad`, `ID_usuario`, `ID_actividad`, `longitud_actividad`, `latitud_actividad`) VALUES ('Ubicacion de: ','$fecha_y_hora_actual',$ID_usuario,$ID_actividad, $longitud,$latitud)";

    $result = $conexion->query($sql);
    if ($result) {
        echo "Extio";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "9") {

    $fecha_actual = date("Y-m-d");
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
            VALUES ('$nombreUnico', '$fecha_actual', $ID_usuario, $ID_actividad)";

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
    $sql = "SELECT * FROM `nombre_actividades` WHERE `estado`='Activo' ORDER BY tipo_actividad DESC, nombre_actividad ASC";


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
    $sql = "UPDATE `nombre_actividades` SET `estado`='Inactivo' WHERE ID_nombre_actividad=$ID_nombre_actividad";

    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados en la consulta

        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} elseif ($opcion == "13") {

    $sql = "SELECT 
    usuarios.*,
    saldo.saldo,
    (
    SELECT 
        saldo.saldo - COALESCE(gastos.total_dinero_gastado, 0) + COALESCE(depositos.total_dinero_agregado, 0) AS saldo_restante
    FROM saldo
    LEFT JOIN (
        SELECT
            ID_saldo,
            COALESCE(SUM(dinero_gastado), 0) AS total_dinero_gastado
        FROM gastos
        GROUP BY ID_saldo
    ) AS gastos ON saldo.ID_saldo = gastos.ID_saldo
    LEFT JOIN (
        SELECT
            ID_saldo,
            COALESCE(SUM(dinero_agregado), 0) AS total_dinero_agregado
        FROM depositos
        GROUP BY ID_saldo
    ) AS depositos ON saldo.ID_saldo = depositos.ID_saldo
    WHERE saldo.ID_usuario = usuarios.ID_usuario AND saldo.status_saldo = 'activo'
    ORDER BY saldo.ID_saldo DESC
    LIMIT 1
) AS saldo_restante,

    (
        SELECT 
            ID_saldo
        FROM saldo
        WHERE ID_usuario = usuarios.ID_usuario AND status_saldo = 'activo'
        ORDER BY ID_saldo DESC
        LIMIT 1
    ) AS ID_saldo
    
FROM usuarios
LEFT JOIN saldo ON usuarios.ID_usuario = saldo.ID_usuario AND saldo.status_saldo = 'activo'
ORDER BY usuarios.ID_usuario
";




    /*
$sql="SELECT u.*, s.ID_saldo, s.saldo, (s.saldo - COALESCE(g.gastos_gastos, 0) + COALESCE(g.gastos_depositos, 0)) AS saldo_restante 
FROM usuarios u LEFT JOIN ( SELECT ID_usuario, MAX(ID_saldo) AS ultimo_saldo_id FROM saldo 
WHERE status_saldo = 'activo' 
GROUP BY ID_usuario ) max_saldo ON u.ID_usuario = max_saldo.ID_usuario 
LEFT JOIN saldo s ON max_saldo.ultimo_saldo_id = s.ID_saldo AND s.status_saldo = 'activo' 
LEFT JOIN ( SELECT ID_saldo, SUM(CASE WHEN tipo = 'gasto' THEN dinero_gastado ELSE 0 END) AS gastos_gastos, SUM(CASE WHEN tipo = 'deposito' THEN dinero_gastado ELSE 0 END) AS gastos_depositos FROM gastos GROUP BY ID_saldo ) g ON s.ID_saldo = g.ID_saldo;";
*/


/*
$sql = "SELECT 
    usuarios.*,
    (SELECT 
        saldo.saldo - COALESCE(SUM(gastos.dinero_gastado), 0) + COALESCE(SUM(depositos.dinero_agregado), 0)
        FROM saldo
        LEFT JOIN gastos ON saldo.ID_saldo = gastos.ID_saldo
        LEFT JOIN depositos ON saldo.ID_saldo = depositos.ID_saldo
        WHERE saldo.ID_usuario = usuarios.ID_usuario AND saldo.status_saldo = 'activo'
        GROUP BY saldo.ID_usuario
        ORDER BY saldo.ID_saldo DESC
        LIMIT 1
    ) AS saldo_restante,
    (SELECT 
        ID_saldo
        FROM saldo
        WHERE ID_usuario = usuarios.ID_usuario AND status_saldo = 'activo'
        ORDER BY ID_saldo DESC
        LIMIT 1
    ) AS ID_saldo
FROM usuarios";
*/

/*
    $sql = "SELECT u.*, s.ID_saldo, s.saldo, (s.saldo - COALESCE(g.gastos_gastos, 0) + COALESCE(g.gastos_depositos, 0)) AS saldo_restante 
FROM usuarios u 
LEFT JOIN (
    SELECT ID_usuario, MAX(ID_saldo) AS ultimo_saldo_id 
    FROM saldo 
    WHERE status_saldo = 'activo' 
    GROUP BY ID_usuario
) max_saldo ON u.ID_usuario = max_saldo.ID_usuario 
LEFT JOIN saldo s ON max_saldo.ultimo_saldo_id = s.ID_saldo AND s.status_saldo = 'activo' 
LEFT JOIN (
    SELECT ID_saldo, 
           SUM(CASE WHEN tipo = 'gasto' THEN dinero_gastado ELSE 0 END) AS gastos_gastos, 
           SUM(CASE WHEN tipo = 'deposito' THEN dinero_gastado ELSE 0 END) AS gastos_depositos 
    FROM gastos 
    GROUP BY ID_saldo
) g ON s.ID_saldo = g.ID_saldo
WHERE u.estado = 'Activo';";

*/

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

    $sql = "UPDATE usuarios SET `estado`='Inactivo' WHERE ID_usuario= $ID_usuario";

    $result = $conexion->query($sql);
    if ($result) {

        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }

    /*

    $conexion->begin_transaction();

    // Eliminar fotos_actividades relacionadas con el usuario
    $sql_fotos = "DELETE FROM `fotos_actividades` WHERE ID_usuario=$ID_usuario";
    $result_fotos = $conexion->query($sql_fotos);


    // Eliminar ubicacion_actividades relacionadas con el usuario
    $sql_ubicacion = "DELETE FROM `ubicacion_actividades` WHERE ID_usuario=$ID_usuario";
    $result_ubicacion = $conexion->query($sql_ubicacion);

    // Eliminar actividades relacionadas con el usuario
    $sql_actividades = "DELETE FROM `actividades` WHERE ID_usuario = $ID_usuario";
    $result_actividades = $conexion->query($sql_actividades);

    if ($result_actividades && $result_fotos && $result_ubicacion) {
        // Eliminar al usuario
        $sql_usuario = "DELETE FROM `usuarios` WHERE ID_usuario = $ID_usuario";
        $result_usuario = $conexion->query($sql_usuario);
        // Si todas las eliminaciones se realizaron con éxito, confirmar la transacción
        $conexion->commit();
        echo "Usuario y sus actividades, fotos y ubicaciones relacionadas eliminados con éxito.";
    } else {
        // Si hubo un error en alguna de las eliminaciones, realizar un rollback
        $conexion->rollback();
        echo "Error al eliminar actividades, fotos, ubicaciones o al usuario: " . $conexion->error;
    }
    */
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
} else if ($opcion == "27") {



    /*
    $message = [
        'title' => $TituloMensaje,
        'body' => $CuerpoMensaje,
    ];

    $data = [
        'notification' => $message,
        'to' => $TokenFIREBASE,
    ];

    $options = [
        'http' => [
            'header' => [
                'Content-Type: application/json',
                'Authorization: key=' . $serverKey,
            ],
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents('https://fcm.googleapis.com/fcm/send', false, $context);

    if ($result === FALSE) {
        // Manejar el error
        echo 'Error al enviar la notificación.';
    } else {
        // Procesar la respuesta
        echo 'Notificación enviada correctamente.';
    }
    */


    $message = [
        'title' => $TituloMensaje,
        'body' => $CuerpoMensaje,
    ];

    $data = [
        'notification' => $message,
        'to' => $TokenFIREBASE,
    ];

    $options = [
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: key=' . $serverKey,
        ],
        CURLOPT_POSTFIELDS => json_encode($data),
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);

    if ($result === FALSE) {
        // Manejar el error
        echo 'Error al enviar la notificación.';
    } else {
        // Procesar la respuesta
        echo 'Notificación enviada correctamente.';
    }

    curl_close($ch);
} else if ($opcion == "28") {

    $sql = "UPDATE `usuarios` SET token='$TokenFIREBASE' WHERE ID_usuario=$ID_usuario";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == "51") {
    // Verificar si ya existe un registro con el mismo ID_usuario y status_saldo activo

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql_verificar = "SELECT COUNT(*) as count FROM `saldo` WHERE `ID_usuario` = $ID_usuario AND `status_saldo` = 'activo'";
    $result_verificar = $conexion->query($sql_verificar);

    if ($result_verificar) {
        $row = $result_verificar->fetch_assoc();
        $count = $row['count'];

        // Si no hay coincidencias, realizar la inserción
        if ($count == 0) {
            $sql_insertar = "INSERT INTO `saldo`(`ID_usuario`, `saldo`,`status_saldo`, `fecha_asignacion`, `hora_asignacion`) VALUES ($ID_usuario,$saldo_asignado, 'activo', '$fecha_actual', '$hora_actual')";
            $result_insertar = $conexion->query($sql_insertar);

            if ($result_insertar) {
                echo "Exito";
            } else {
                echo "Error en la consulta de inserción: " . $conexion->error;
            }
        } else {
            echo "Ya tiene un saldo activo, debes finalizarlo antes de asignar otro";
        }
    } else {
        echo "Error en la consulta de verificación: " . $conexion->error;
    }
}

/* 
else if ($opcion == "51") {




    $sql = "INSERT INTO `saldo`(`ID_usuario`, `saldo`,`status_saldo`,`status_saldo`,`status_saldo`, `fecha_asignacion`, `hora_asignacion`) VALUES ($ID_usuario,$saldo_asignado, 'activo', NOW(), NOW())";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
}

*/ else if ($opcion == "52") {
   

    $sql = "SELECT 
    s.ID_saldo,
    s.ID_usuario,
    s.status_saldo,
    s.saldo - COALESCE(SUM(CASE WHEN g.tipo = 'gasto' THEN g.dinero_gastado ELSE 0 END), 0) +
                 COALESCE(SUM(CASE WHEN g.tipo = 'deposito' THEN g.dinero_gastado ELSE 0 END), 0) AS saldo_actualizado,
    COALESCE(SUM(CASE WHEN g.tipo_caja = 'Gastos' THEN g.dinero_gastado ELSE 0 END), 0) AS total_gastos,
    COALESCE(SUM(CASE WHEN g.tipo_caja = 'Capital' THEN g.dinero_gastado ELSE 0 END), 0) AS total_capital
FROM 
    saldo s
LEFT JOIN 
    gastos g ON s.ID_saldo = g.ID_saldo
WHERE 
    s.ID_usuario = $ID_usuario AND s.status_saldo = 'activo'
GROUP BY 
    s.ID_saldo, s.ID_usuario, s.status_saldo, s.saldo
ORDER BY 
    s.ID_saldo DESC
LIMIT 1";


    /*
    $sql = "SELECT 
s.ID_saldo,
s.ID_usuario,
s.status_saldo,
s.saldo - COALESCE(SUM(CASE WHEN g.tipo = 'gasto' THEN g.dinero_gastado ELSE 0 END), 0) +
             COALESCE(SUM(CASE WHEN g.tipo = 'deposito' THEN g.dinero_gastado ELSE 0 END), 0) AS saldo_actualizado
FROM 
saldo s
LEFT JOIN 
gastos g ON s.ID_saldo = g.ID_saldo
WHERE 
s.ID_usuario = $ID_usuario AND s.status_saldo = 'activo'
GROUP BY 
s.ID_saldo, s.ID_usuario, s.status_saldo, s.saldo
ORDER BY 
s.ID_saldo DESC
LIMIT 1";
*/

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
            echo "sin saldo activo";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == "53") {


    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql = "INSERT INTO `gastos`(`dinero_gastado`, `fecha`, `hora`, `ID_saldo`, `ID_actividad`,`tipo` ) VALUES ($total_gastado, '$fecha_actual' , '$hora_actual' ,$ID_saldo,$ID_actividad, 'gasto')";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";

        $fechaFin = date("Y-m-d H:i:s");
        $sqlUpdate = "UPDATE actividades SET estadoActividad='Finalizado', fecha_fin='$fechaFin', motivocancelacion='Todo correcto' WHERE ID_actividad=$ID_actividad";
        $resultUpdate = $conexion->query($sqlUpdate);

        if ($resultUpdate) {
            echo " Segunda consulta realizada con éxito";
        } else {
            echo " Error en la segunda consulta: " . $conexion->error;
        }
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }

    /*

    $sql = "INSERT INTO `gastos`(`dinero_gastado`, `fecha`, `hora`, `ID_saldo`, `ID_actividad`) VALUES ($total_gastado, CURDATE() , CURTIME() ,$ID_saldo,$ID_actividad)";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }


    */
} else if ($opcion == "54") {

    $sql = "SELECT 
    saldo.ID_saldo,
    saldo.ID_usuario,
    saldo.fecha_asignacion,
    saldo.hora_asignacion,
    saldo.caja,
    saldo.saldo AS saldo_inicial,
    saldo.saldo - COALESCE(gastos.total_dinero_gastado, 0) + COALESCE(depositos.total_dinero_agregado, 0) AS nuevo_saldo,
    COALESCE(gastos.total_dinero_gastado, 0) AS total_dinero_gastado,
    COALESCE(depositos.total_dinero_agregado, 0) AS total_dinero_agregado,
    COALESCE(gastos.gastos_Cajagastos, 0) AS gastos_Cajagastos,
    COALESCE(gastos.gastos_CajaCapital, 0) AS gastos_CajaCapital,
    COALESCE(depositos.depositos_Cajagastos, 0) AS depositos_Cajagastos,
    COALESCE(depositos.depositos_CajaCapital, 0) AS depositos_CajaCapital
FROM saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_gastado), 0) AS total_dinero_gastado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_gastado END), 0) AS gastos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_gastado END), 0) AS gastos_CajaCapital
    FROM gastos
    GROUP BY ID_saldo
) AS gastos ON saldo.ID_saldo = gastos.ID_saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_agregado), 0) AS total_dinero_agregado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_agregado END), 0) AS depositos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_agregado END), 0) AS depositos_CajaCapital
    FROM depositos
    GROUP BY ID_saldo
) AS depositos ON saldo.ID_saldo = depositos.ID_saldo
WHERE saldo.ID_saldo = $ID_saldo
ORDER BY saldo.ID_saldo DESC
LIMIT 1";

$result = $conexion->query($sql);

if ($result) {
    // Verificar si se encontraron resultados en la consulta principal
    if ($result->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $response['ID_saldo'] = $row['ID_saldo'];
            $response['caja'] = $row['caja'];
            $response['saldo_inicial'] = $row['saldo_inicial'];
            $response['fecha_asignacion'] = $row['fecha_asignacion'];
            $response['hora_asignacion'] = $row['hora_asignacion'];
            $response['nuevo_saldo'] = $row['nuevo_saldo'];
            $response['total_dinero_gastado'] = $row['total_dinero_gastado'];
            $response['total_dinero_agregado'] = $row['total_dinero_agregado'];
            $response['gastos_Cajagastos'] = $row['gastos_Cajagastos'];
            $response['gastos_CajaCapital'] = $row['gastos_CajaCapital'];
            $response['depositos_Cajagastos'] = $row['depositos_Cajagastos'];
            $response['depositos_CajaCapital'] = $row['depositos_CajaCapital'];

            // Consulta secundaria para obtener detalles de gastos
            $sqlDetallesGastos = "SELECT * FROM gastos WHERE ID_saldo = {$row['ID_saldo']}";
            $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

            if ($resultDetallesGastos) {
                $detallesGastos = array();
                while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                    $detallesGastos[] = $rowDetallesGastos;
                }

                // Agregar detalles de gastos al array de respuesta
                $response['gastos'] = $detallesGastos;
            }

            // Consulta secundaria para obtener detalles de depósitos
            $sqlDetallesDepositos = "SELECT * FROM depositos WHERE ID_saldo = {$row['ID_saldo']}";
            $resultDetallesDepositos = $conexion->query($sqlDetallesDepositos);

            if ($resultDetallesDepositos) {
                $detallesDepositos = array();
                while ($rowDetallesDepositos = $resultDetallesDepositos->fetch_assoc()) {
                    $detallesDepositos[] = $rowDetallesDepositos;
                }

                // Agregar detalles de depósitos al array de respuesta
                $response['depositos'] = $detallesDepositos;
            }
        }

        echo json_encode($response);
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}


/*
    $sql = "SELECT 
    saldo.*,
    saldo.saldo AS saldo_inicial,
    COALESCE(SUM(CASE WHEN gastos.tipo_caja = 'Gastos' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_gastos,
    COALESCE(SUM(CASE WHEN gastos.tipo_caja = 'Capital' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_depositos,
    saldo.saldo - COALESCE(SUM(CASE WHEN gastos.tipo_caja = 'Gastos' THEN gastos.dinero_gastado ELSE 0 END), 0) + COALESCE(SUM(CASE WHEN gastos.tipo_caja = 'Capital' THEN gastos.dinero_gastado ELSE 0 END), 0) AS nuevo_saldo
FROM 
    saldo
LEFT JOIN 
    gastos ON gastos.ID_saldo = saldo.ID_saldo
WHERE 
    saldo.ID_saldo = $ID_saldo
GROUP BY 
    saldo.ID_saldo, saldo.saldo";

$result = $conexion->query($sql);

if ($result) {
    // Verificar si se encontraron resultados en la consulta principal
    if ($result->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $response['ID_saldo'] = $row['ID_saldo'];
            $response['saldo_inicial'] = $row['saldo_inicial'];
            $response['total_gastos'] = $row['total_gastos'];
            $response['nuevo_saldo'] = $row['nuevo_saldo'];
            $response['fecha_asignacion'] = $row['fecha_asignacion'];
            $response['hora_asignacion'] = $row['hora_asignacion'];
            $response['total_depositos'] = $row['total_depositos'];

            // Consulta secundaria para obtener detalles de gastos
            $sqlDetallesGastos = "SELECT * FROM gastos WHERE ID_saldo = $ID_saldo";
            $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

            if ($resultDetallesGastos) {
                $detallesGastos = array();
                while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                    $detallesGastos[] = $rowDetallesGastos;
                }

                // Agregar detalles de gastos al array de respuesta
                $response['gastos'] = $detallesGastos;
            }

            // Consulta secundaria para obtener detalles de depósitos
            $sqlDetallesDepositos = "SELECT * FROM depositos WHERE ID_saldo = $ID_saldo";
            $resultDetallesDepositos = $conexion->query($sqlDetallesDepositos);

            if ($resultDetallesDepositos) {
                $detallesDepositos = array();
                while ($rowDetallesDepositos = $resultDetallesDepositos->fetch_assoc()) {
                    $detallesDepositos[] = $rowDetallesDepositos;
                }

                // Agregar detalles de depósitos al array de respuesta
                $response['depositos'] = $detallesDepositos;
            }
        }

        echo json_encode($response);
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}


    /*
    $sql = "SELECT 
saldo.*,
saldo.saldo AS saldo_inicial,
COALESCE(SUM(CASE WHEN gastos.tipo = 'gasto' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_gastos,
COALESCE(SUM(CASE WHEN gastos.tipo = 'deposito' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_depositos,
saldo.saldo - COALESCE(SUM(CASE WHEN gastos.tipo = 'gasto' THEN gastos.dinero_gastado ELSE 0 END), 0) + COALESCE(SUM(CASE WHEN gastos.tipo = 'deposito' THEN gastos.dinero_gastado ELSE 0 END), 0) AS nuevo_saldo
FROM 
saldo
LEFT JOIN 
gastos ON gastos.ID_saldo = saldo.ID_saldo
WHERE 
saldo.ID_saldo = $ID_saldo
GROUP BY 
saldo.ID_saldo, saldo.saldo";


    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados en la consulta principal
        if ($result->num_rows > 0) {
            // El usuario y la contraseña son válidos
            $response = array();
            while ($row = $result->fetch_assoc()) {
                $response['ID_saldo'] = $row['ID_saldo'];
                $response['saldo_inicial'] = $row['saldo_inicial'];
                $response['total_gastos'] = $row['total_gastos'];
                $response['nuevo_saldo'] = $row['nuevo_saldo'];
                $response['fecha_asignacion'] = $row['fecha_asignacion'];
                $response['hora_asignacion'] = $row['hora_asignacion'];
                $response['total_depositos'] = $row['total_depositos'];

                // Consulta secundaria para obtener detalles de gastos
                $sqlDetallesGastos = "SELECT * FROM gastos WHERE ID_saldo = $ID_saldo";
                $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

                if ($resultDetallesGastos) {
                    $detallesGastos = array();
                    while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                        $detallesGastos[] = $rowDetallesGastos;
                    }

                    // Agregar detalles de gastos al array de respuesta
                    $response['gastos'] = $detallesGastos;
                }
            }

            echo json_encode($response);
        } else {
            // No se encontraron resultados
            echo "No se encontraron resultados";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }

    */
} else if ($opcion == "55") {


    $sql = "UPDATE `saldo` SET `saldo`=$nuevoSaldo, `caja`='$NuevaCaja' WHERE ID_saldo= $ID_saldo";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }


} else if ($opcion == "56") {

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql = "UPDATE `saldo` SET `status_saldo`='Finalizado', `fecha_final`='$fecha_actual',`hora_final`='$hora_actual'  WHERE ID_saldo= $ID_saldo";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == "57") {


    $sql = "SELECT 
    saldo.ID_saldo,
    saldo.ID_usuario,
    saldo.fecha_asignacion,
    saldo.hora_asignacion,
    saldo.status_saldo,
    saldo.caja,
    saldo.saldo AS saldo_inicial,
    saldo.saldo - COALESCE(gastos.total_dinero_gastado, 0) + COALESCE(depositos.total_dinero_agregado, 0) AS nuevo_saldo,
    COALESCE(gastos.total_dinero_gastado, 0) AS total_dinero_gastado,
    COALESCE(depositos.total_dinero_agregado, 0) AS total_dinero_agregado,
    COALESCE(gastos.gastos_Cajagastos, 0) AS gastos_Cajagastos,
    COALESCE(gastos.gastos_CajaCapital, 0) AS gastos_CajaCapital,
    COALESCE(depositos.depositos_Cajagastos, 0) AS depositos_Cajagastos,
    COALESCE(depositos.depositos_CajaCapital, 0) AS depositos_CajaCapital
FROM saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_gastado), 0) AS total_dinero_gastado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_gastado END), 0) AS gastos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_gastado END), 0) AS gastos_CajaCapital
    FROM gastos
    GROUP BY ID_saldo
) AS gastos ON saldo.ID_saldo = gastos.ID_saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_agregado), 0) AS total_dinero_agregado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_agregado END), 0) AS depositos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_agregado END), 0) AS depositos_CajaCapital
    FROM depositos
    GROUP BY ID_saldo
) AS depositos ON saldo.ID_saldo = depositos.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario
ORDER BY saldo.ID_saldo DESC";

$result = $conexion->query($sql);

if ($result) {
    // Verificar si se encontraron resultados en la consulta principal
    if ($result->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $saldoInfo = array(
                'ID_saldo' => $row['ID_saldo'],
                'caja' => $row['caja'],
                'saldo_inicial' => $row['saldo_inicial'],
                'status_saldo' => $row['status_saldo'],
                'fecha_asignacion' => $row['fecha_asignacion'],
                'hora_asignacion' => $row['hora_asignacion'],
                'nuevo_saldo' => $row['nuevo_saldo'],
                'total_dinero_gastado' => $row['total_dinero_gastado'],
                'total_dinero_agregado' => $row['total_dinero_agregado'],
                'gastos_Cajagastos' => $row['gastos_Cajagastos'],
                'gastos_CajaCapital' => $row['gastos_CajaCapital'],
                'depositos_Cajagastos' => $row['depositos_Cajagastos'],
                'depositos_CajaCapital' => $row['depositos_CajaCapital']
            );

            // Consulta secundaria para obtener detalles de gastos
$sqlDetallesGastos="SELECT * FROM gastos LEFT OUTER JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad 
LEFT OUTER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad WHERE ID_saldo ={$row['ID_saldo']}";
/*

            $sqlDetallesGastos = "SELECT * FROM gastos WHERE ID_saldo = {$row['ID_saldo']}    ";

$sqlDetallesGastos="SELECT * FROM gastos LEFT OUTER JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad 
LEFT OUTER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad WHERE ID_saldo ={$row['ID_saldo']}";
*/
            $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

            if ($resultDetallesGastos) {
                $detallesGastos = array();
                while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                    $detallesGastos[] = $rowDetallesGastos;
                }

                // Agregar detalles de gastos al array de saldoInfo
                $saldoInfo['gastos'] = $detallesGastos;
            }

            // Consulta secundaria para obtener detalles de depósitos
            $sqlDetallesDepositos = "SELECT * FROM depositos WHERE ID_saldo = {$row['ID_saldo']}";
            $resultDetallesDepositos = $conexion->query($sqlDetallesDepositos);

            if ($resultDetallesDepositos) {
                $detallesDepositos = array();
                while ($rowDetallesDepositos = $resultDetallesDepositos->fetch_assoc()) {
                    $detallesDepositos[] = $rowDetallesDepositos;
                }

                // Agregar detalles de depósitos al array de saldoInfo
                $saldoInfo['depositos'] = $detallesDepositos;
            }

            // Agregar el array de información de saldo al array de respuesta
            $response[] = $saldoInfo;
        }

        echo json_encode($response);
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}

/*
    $sql = "SELECT 
saldo.*,
saldo.saldo AS saldo_inicial,
COALESCE(SUM(CASE WHEN gastos.tipo = 'gasto' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_gastos,
COALESCE(SUM(CASE WHEN gastos.tipo = 'deposito' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_depositos,
saldo.saldo - COALESCE(SUM(CASE WHEN gastos.tipo = 'gasto' THEN gastos.dinero_gastado ELSE 0 END), 0) + COALESCE(SUM(CASE WHEN gastos.tipo = 'deposito' THEN gastos.dinero_gastado ELSE 0 END), 0) AS nuevo_saldo
FROM 
saldo
LEFT JOIN 
gastos ON gastos.ID_saldo = saldo.ID_saldo
WHERE 
saldo.ID_usuario = $ID_usuario
GROUP BY 
saldo.ID_usuario, saldo.ID_saldo, saldo.saldo
ORDER BY 
saldo.fecha_asignacion DESC";



    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados en la consulta principal
        if ($result->num_rows > 0) {
            // El usuario y la contraseña son válidos
            $response = array();
            while ($row = $result->fetch_assoc()) {
                $ID_saldo = $row['ID_saldo'];  // Obtener el ID_saldo actual

                $response[] = array(
                    'ID_saldo' => $ID_saldo,
                    'saldo_inicial' => $row['saldo_inicial'],
                    'total_gastos' => $row['total_gastos'],
                    'nuevo_saldo' => $row['nuevo_saldo'],
                    'fecha_asignacion' => $row['fecha_asignacion'],
                    'hora_asignacion' => $row['hora_asignacion'],
                    'status_saldo' => $row['status_saldo'],
                    'total_depositos' => $row['total_depositos'],
                );

                // Consulta secundaria para obtener detalles de gastos
                $sqlDetallesGastos = "SELECT gastos.*, actividades.*, nombre_actividades.*
                FROM gastos
              LEFT OUTER  JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad
              LEFT OUTER   JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
                WHERE gastos.ID_saldo = $ID_saldo";
                $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

                if ($resultDetallesGastos) {
                    $detallesGastos = array();
                    while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                        $detallesGastos[] = $rowDetallesGastos;
                    }

                    // Agregar detalles de gastos al array de respuesta
                    $response[count($response) - 1]['gastos'] = $detallesGastos;
                }
            }

            echo json_encode($response);
        } else {
            // No se encontraron resultados
            echo "No se encontraron resultados";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }

    */
} else if ($opcion == "58") {



    $sql = "SELECT 
    saldo.ID_saldo,
    saldo.ID_usuario,
    saldo.fecha_asignacion,
    saldo.hora_asignacion,
    saldo.status_saldo,
    saldo.caja,
    saldo.saldo AS saldo_inicial,
    saldo.saldo - COALESCE(gastos.total_dinero_gastado, 0) + COALESCE(depositos.total_dinero_agregado, 0) AS nuevo_saldo,
    COALESCE(gastos.total_dinero_gastado, 0) AS total_dinero_gastado,
    COALESCE(depositos.total_dinero_agregado, 0) AS total_dinero_agregado,
    COALESCE(gastos.gastos_Cajagastos, 0) AS gastos_Cajagastos,
    COALESCE(gastos.gastos_CajaCapital, 0) AS gastos_CajaCapital,
    COALESCE(depositos.depositos_Cajagastos, 0) AS depositos_Cajagastos,
    COALESCE(depositos.depositos_CajaCapital, 0) AS depositos_CajaCapital
FROM saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_gastado), 0) AS total_dinero_gastado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_gastado END), 0) AS gastos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_gastado END), 0) AS gastos_CajaCapital
    FROM gastos
    GROUP BY ID_saldo
) AS gastos ON saldo.ID_saldo = gastos.ID_saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_agregado), 0) AS total_dinero_agregado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_agregado END), 0) AS depositos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_agregado END), 0) AS depositos_CajaCapital
    FROM depositos
    GROUP BY ID_saldo
)  AS depositos ON saldo.ID_saldo = depositos.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario
    AND saldo.fecha_asignacion BETWEEN '$fechaInicio' AND '$fechaFin' 
ORDER BY saldo.ID_saldo DESC";

$result = $conexion->query($sql);

if ($result) {
    // Verificar si se encontraron resultados en la consulta principal
    if ($result->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $saldoInfo = array(
                'ID_saldo' => $row['ID_saldo'],
                'caja' => $row['caja'],
                'saldo_inicial' => $row['saldo_inicial'],
                'status_saldo' => $row['status_saldo'],
                'fecha_asignacion' => $row['fecha_asignacion'],
                'hora_asignacion' => $row['hora_asignacion'],
                'nuevo_saldo' => $row['nuevo_saldo'],
                'total_dinero_gastado' => $row['total_dinero_gastado'],
                'total_dinero_agregado' => $row['total_dinero_agregado'],
                'gastos_Cajagastos' => $row['gastos_Cajagastos'],
                'gastos_CajaCapital' => $row['gastos_CajaCapital'],
                'depositos_Cajagastos' => $row['depositos_Cajagastos'],
                'depositos_CajaCapital' => $row['depositos_CajaCapital']
            );

            // Consulta secundaria para obtener detalles de gastos
$sqlDetallesGastos="SELECT * FROM gastos LEFT OUTER JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad 
LEFT OUTER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad WHERE ID_saldo ={$row['ID_saldo']}";
/*

            $sqlDetallesGastos = "SELECT * FROM gastos WHERE ID_saldo = {$row['ID_saldo']}    ";

$sqlDetallesGastos="SELECT * FROM gastos LEFT OUTER JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad 
LEFT OUTER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad WHERE ID_saldo ={$row['ID_saldo']}";
*/
            $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

            if ($resultDetallesGastos) {
                $detallesGastos = array();
                while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                    $detallesGastos[] = $rowDetallesGastos;
                }

                // Agregar detalles de gastos al array de saldoInfo
                $saldoInfo['gastos'] = $detallesGastos;
            }

            // Consulta secundaria para obtener detalles de depósitos
            $sqlDetallesDepositos = "SELECT * FROM depositos WHERE ID_saldo = {$row['ID_saldo']}";
            $resultDetallesDepositos = $conexion->query($sqlDetallesDepositos);

            if ($resultDetallesDepositos) {
                $detallesDepositos = array();
                while ($rowDetallesDepositos = $resultDetallesDepositos->fetch_assoc()) {
                    $detallesDepositos[] = $rowDetallesDepositos;
                }

                // Agregar detalles de depósitos al array de saldoInfo
                $saldoInfo['depositos'] = $detallesDepositos;
            }

            // Agregar el array de información de saldo al array de respuesta
            $response[] = $saldoInfo;
        }

        echo json_encode($response);
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}

    /*
    $sql = "SELECT 
    saldo.ID_saldo,
    saldo.ID_usuario,
    saldo.fecha_asignacion,
    saldo.hora_asignacion,
    saldo.caja,
    saldo.status_saldo,
    saldo.saldo AS saldo_inicial,
    saldo.saldo - COALESCE(gastos.total_dinero_gastado, 0) + COALESCE(depositos.total_dinero_agregado, 0) AS nuevo_saldo,
    COALESCE(gastos.total_dinero_gastado, 0) AS total_dinero_gastado,
    COALESCE(depositos.total_dinero_agregado, 0) AS total_dinero_agregado,
    COALESCE(gastos.gastos_Cajagastos, 0) AS gastos_Cajagastos,
    COALESCE(gastos.gastos_CajaCapital, 0) AS gastos_CajaCapital,
    COALESCE(depositos.depositos_Cajagastos, 0) AS depositos_Cajagastos,
    COALESCE(depositos.depositos_CajaCapital, 0) AS depositos_CajaCapital
FROM saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_gastado), 0) AS total_dinero_gastado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_gastado END), 0) AS gastos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_gastado END), 0) AS gastos_CajaCapital
    FROM gastos
    GROUP BY ID_saldo
) AS gastos ON saldo.ID_saldo = gastos.ID_saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_agregado), 0) AS total_dinero_agregado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_agregado END), 0) AS depositos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_agregado END), 0) AS depositos_CajaCapital
    FROM depositos
    GROUP BY ID_saldo
) AS depositos ON saldo.ID_saldo = depositos.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario
    AND saldo.fecha_asignacion BETWEEN '$fechaInicio' AND '$fechaFin' -- Modifica las fechas según tu rango
ORDER BY saldo.ID_saldo DESC";

$result = $conexion->query($sql);

if ($result) {
    // Verificar si se encontraron resultados en la consulta principal
    if ($result->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $response = array();
        while ($row = $result->fetch_assoc()) {
            $saldoInfo = array(
                'ID_saldo' => $row['ID_saldo'],
                'caja' => $row['caja'],
                'saldo_inicial' => $row['saldo_inicial'],
                'status_saldo' => $row['status_saldo'],
                
                'fecha_asignacion' => $row['fecha_asignacion'],
                'hora_asignacion' => $row['hora_asignacion'],
                'nuevo_saldo' => $row['nuevo_saldo'],
                'total_dinero_gastado' => $row['total_dinero_gastado'],
                'total_dinero_agregado' => $row['total_dinero_agregado'],
                'gastos_Cajagastos' => $row['gastos_Cajagastos'],
                'gastos_CajaCapital' => $row['gastos_CajaCapital'],
                'depositos_Cajagastos' => $row['depositos_Cajagastos'],
                'depositos_CajaCapital' => $row['depositos_CajaCapital']
            );

            // Consulta secundaria para obtener detalles de gastos
            $sqlDetallesGastos = "SELECT * FROM gastos WHERE ID_saldo = {$row['ID_saldo']}";
            $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

            if ($resultDetallesGastos) {
                $detallesGastos = array();
                while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                    $detallesGastos[] = $rowDetallesGastos;
                }

                // Agregar detalles de gastos al array de saldoInfo
                $saldoInfo['gastos'] = $detallesGastos;
            }

            // Consulta secundaria para obtener detalles de depósitos
            $sqlDetallesDepositos = "SELECT * FROM depositos WHERE ID_saldo = {$row['ID_saldo']}";
            $resultDetallesDepositos = $conexion->query($sqlDetallesDepositos);

            if ($resultDetallesDepositos) {
                $detallesDepositos = array();
                while ($rowDetallesDepositos = $resultDetallesDepositos->fetch_assoc()) {
                    $detallesDepositos[] = $rowDetallesDepositos;
                }

                // Agregar detalles de depósitos al array de saldoInfo
                $saldoInfo['depositos'] = $detallesDepositos;
            }

            // Agregar el array de información de saldo al array de respuesta
            $response[] = $saldoInfo;
        }

        echo json_encode($response);
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}

    /*
    // Consulta principal para obtener saldo y resumen de gastos con filtro por fechas
    $sql = "SELECT saldo.*, 
    saldo.saldo AS saldo_inicial, 
    COALESCE(SUM(gastos.dinero_gastado), 0) AS total_gastos, 
    saldo.saldo - COALESCE(SUM(gastos.dinero_gastado), 0) AS nuevo_saldo
FROM saldo
LEFT JOIN gastos ON gastos.ID_saldo = saldo.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario  
AND saldo.fecha_asignacion BETWEEN '$fechaInicio' AND '$fechaFin'
GROUP BY saldo.ID_saldo, saldo.saldo
ORDER BY saldo.fecha_asignacion DESC";

*/



/*

    $sql = "SELECT 
saldo.*,
saldo.saldo AS saldo_inicial,
COALESCE(SUM(CASE WHEN gastos.tipo = 'gasto' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_gastos,
COALESCE(SUM(CASE WHEN gastos.tipo = 'deposito' THEN gastos.dinero_gastado ELSE 0 END), 0) AS total_depositos,
saldo.saldo - COALESCE(SUM(CASE WHEN gastos.tipo = 'gasto' THEN gastos.dinero_gastado ELSE 0 END), 0) + COALESCE(SUM(CASE WHEN gastos.tipo = 'deposito' THEN gastos.dinero_gastado ELSE 0 END), 0) AS nuevo_saldo
FROM 
saldo
LEFT JOIN 
gastos ON gastos.ID_saldo = saldo.ID_saldo
WHERE 
saldo.ID_usuario = $ID_usuario
AND saldo.fecha_asignacion BETWEEN '$fechaInicio' AND '$fechaFin'
GROUP BY 
saldo.ID_usuario, saldo.ID_saldo, saldo.saldo
ORDER BY 
saldo.fecha_asignacion DESC";


    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados en la consulta principal
        if ($result->num_rows > 0) {
            // El usuario y la contraseña son válidos
            $response = array();
            while ($row = $result->fetch_assoc()) {
                $ID_saldo = $row['ID_saldo'];  // Obtener el ID_saldo actual

                $response[] = array(
                    'ID_saldo' => $ID_saldo,
                    'saldo_inicial' => $row['saldo_inicial'],
                    'total_gastos' => $row['total_gastos'],
                    'nuevo_saldo' => $row['nuevo_saldo'],
                    'fecha_asignacion' => $row['fecha_asignacion'],
                    'hora_asignacion' => $row['hora_asignacion'],
                    'status_saldo' => $row['status_saldo'],
                    'total_depositos' => $row['total_depositos'],
                );

                // Consulta secundaria para obtener detalles de gastos
                $sqlDetallesGastos = "SELECT gastos.*, actividades.*, nombre_actividades.*
                FROM gastos
              LEFT OUTER  JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad
              LEFT OUTER  JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
                WHERE gastos.ID_saldo = $ID_saldo";
                $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

                if ($resultDetallesGastos) {
                    $detallesGastos = array();
                    while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                        $detallesGastos[] = $rowDetallesGastos;
                    }

                    // Agregar detalles de gastos al array de respuesta
                    $response[count($response) - 1]['gastos'] = $detallesGastos;
                }
            }

            echo json_encode($response);
        } else {
            // No se encontraron resultados
            echo "No se encontraron resultados";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }


    */
} else if ($opcion == 59) {
    header("Location: disenioPDF.php?id=$ID_usuario&fechaInicio=$fechaInicio&fechaFin=$fechaFin");
    exit();
} else if ($opcion == 60) {

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql = "INSERT INTO `gastos`(`dinero_gastado`, `fecha`, `hora`, `ID_saldo`, `ID_actividad`, `tipo`) VALUES ($deposito,'$fecha_actual','$hora_actual',$ID_saldo,null,'deposito')";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == 61) {
    header("Location: disenioPDFActividades.php?id=$ID_usuario&rango=$rango");
    exit();
} else if ($opcion == 62) {

    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql_verificar = "SELECT COUNT(*) as count FROM `saldo` WHERE `ID_usuario` = $ID_usuario AND `status_saldo` = 'activo'";
    $result_verificar = $conexion->query($sql_verificar);

    if ($result_verificar) {
        $row = $result_verificar->fetch_assoc();
        $count = $row['count'];

        // Si no hay coincidencias, realizar la inserción
        if ($count == 0) {
            $sql_insertar = "INSERT INTO `saldo`(`ID_usuario`, `saldo`,`status_saldo`, `fecha_asignacion`, `hora_asignacion`,`caja` ) VALUES ($ID_usuario,$saldo_asignado, 'activo', '$fecha_actual', '$hora_actual', '$tipo_caja')";
            $result_insertar = $conexion->query($sql_insertar);

            if ($result_insertar) {
                echo "Exito";
            } else {
                echo "Error en la consulta de inserción: " . $conexion->error;
            }
        } else {
            echo "Ya tiene un saldo activo, debes finalizarlo antes de asignar otro";
        }
    } else {
        echo "Error en la consulta de verificación: " . $conexion->error;
    }
} else if ($opcion == "63") {



    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql = "INSERT INTO `gastos`(`dinero_gastado`, `fecha`, `hora`, `ID_saldo`, `ID_actividad`,`tipo`, `tipo_caja` ) VALUES ($total_gastado, '$fecha_actual' , '$hora_actual' ,$ID_saldo,$ID_actividad, 'gasto', '$tipo_caja')";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";

        $fechaFin = date("Y-m-d H:i:s");
        $sqlUpdate = "UPDATE actividades SET estadoActividad='Finalizado', fecha_fin='$fechaFin', motivocancelacion='Todo correcto' WHERE ID_actividad=$ID_actividad";
        $resultUpdate = $conexion->query($sqlUpdate);

        if ($resultUpdate) {
            echo " Segunda consulta realizada con éxito";
        } else {
            echo " Error en la segunda consulta: " . $conexion->error;
        }
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == "64") {


    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");

    $sql = "INSERT INTO `depositos`(`dinero_agregado`, `fecha`, `hora`, `ID_saldo`, `tipo_caja`) VALUES ($deposito,'$fecha_actual','$hora_actual',$ID_saldo,'$tipo_caja')";
    $result = $conexion->query($sql);

    if ($result) {
        echo "Exito";
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} else if ($opcion == "65") {


    $sql = "SELECT 
    saldo.ID_saldo,
    saldo.ID_usuario,
    saldo.caja,
    saldo.status_saldo,
    saldo.saldo AS saldo_inicial,
    saldo.saldo - COALESCE(gastos.total_dinero_gastado, 0) + COALESCE(depositos.total_dinero_agregado, 0) AS saldo_actualizado,
    COALESCE(gastos.total_dinero_gastado, 0) AS total_dinero_gastado,
    COALESCE(depositos.total_dinero_agregado, 0) AS total_dinero_agregado,
    COALESCE(gastos.gastos_Cajagastos, 0) AS gastos_Cajagastos,
    COALESCE(gastos.gastos_CajaCapital, 0) AS gastos_CajaCapital,
    COALESCE(depositos.depositos_Cajagastos, 0) AS depositos_Cajagastos,
    COALESCE(depositos.depositos_CajaCapital, 0) AS depositos_CajaCapital
FROM saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_gastado), 0) AS total_dinero_gastado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_gastado END), 0) AS gastos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_gastado END), 0) AS gastos_CajaCapital
    FROM gastos
    GROUP BY ID_saldo
) AS gastos ON saldo.ID_saldo = gastos.ID_saldo
LEFT JOIN (
    SELECT
        ID_saldo,
        COALESCE(SUM(dinero_agregado), 0) AS total_dinero_agregado,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Gastos' THEN dinero_agregado END), 0) AS depositos_Cajagastos,
        COALESCE(SUM(CASE WHEN tipo_caja = 'Capital' THEN dinero_agregado END), 0) AS depositos_CajaCapital
    FROM depositos
    GROUP BY ID_saldo
) AS depositos ON saldo.ID_saldo = depositos.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario
ORDER BY saldo.ID_saldo DESC
LIMIT 1";

/*
    $sql = "SELECT 
    saldo.ID_saldo,
    saldo.ID_usuario,
    saldo.saldo AS saldo_inicial,
    saldo.saldo - COALESCE(SUM(DISTINCT gastos.dinero_gastado), 0) + COALESCE(SUM(DISTINCT depositos.dinero_agregado), 0) AS saldo_actualizado,
    COALESCE(SUM(DISTINCT gastos.dinero_gastado), 0) AS total_dinero_gastado,
    COALESCE(SUM(DISTINCT depositos.dinero_agregado), 0) AS total_dinero_agregado,
    COALESCE(SUM(DISTINCT CASE WHEN gastos.tipo_caja = 'Gastos' THEN gastos.dinero_gastado END), 0) AS gastos_Cajagastos,
    COALESCE(SUM(DISTINCT CASE WHEN gastos.tipo_caja = 'Capital' THEN gastos.dinero_gastado END), 0) AS gastos_CajaCapital,
    COALESCE(SUM(DISTINCT CASE WHEN depositos.tipo_caja = 'Gastos' THEN depositos.dinero_agregado END), 0) AS depositos_Cajagastos,
    COALESCE(SUM(DISTINCT CASE WHEN depositos.tipo_caja = 'Capital' THEN depositos.dinero_agregado END), 0) AS depositos_CajaCapital
FROM saldo
LEFT JOIN gastos ON saldo.ID_saldo = gastos.ID_saldo
LEFT JOIN depositos ON saldo.ID_saldo = depositos.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario
GROUP BY saldo.ID_saldo, saldo.ID_usuario, saldo.saldo
ORDER BY saldo.ID_saldo DESC
LIMIT 1";
*/



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
            echo "sin saldo activo";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta: " . $conexion->error;
    }
} 

else {
    echo "Opción no válida";
}










$conexion->close();
