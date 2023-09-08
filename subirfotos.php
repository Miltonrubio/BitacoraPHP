<?php
// Verificar si se ha enviado un archivo
if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Obtener información del archivo
    $nombreArchivo = $_FILES['imagen']['name'];
    $tipoArchivo = $_FILES['imagen']['type'];
    $tamañoArchivo = $_FILES['imagen']['size'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];

    // Definir la ruta donde se guardará la imagen
    $rutaDestino = 'fotos/' . $nombreArchivo;

    // Crear la carpeta 'fotos' si no existe
    if (!file_exists('fotos')) {
        mkdir('fotos', 0777, true);
    }

    // Mover la imagen de la ruta temporal a la ruta de destino
    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        // Aquí puedes insertar la ruta de la imagen en la base de datos
        // Ejemplo de conexión a la base de datos y consulta SQL
        $conexion = new mysqli('localhost', 'root', '', 'bitacora');
        
        if ($conexion->connect_error) {
            die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
        }
        
        $sql = "INSERT INTO imagenes (nombre, ruta) VALUES ('$nombreArchivo', '$rutaDestino')";
        if ($conexion->query($sql) === TRUE) {
            echo "La imagen se ha subido y registrado correctamente en la base de datos.";
        } else {
            echo "Error al registrar la imagen en la base de datos: " . $conexion->error;
        }

        $conexion->close();
    } else {
        echo "Hubo un error al subir la imagen.";
    }
} else {
    echo "Error al cargar la imagen.";
}
?>