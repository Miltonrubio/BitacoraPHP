<?php

ob_start();

require_once "conexion.php";


$ID_usuario = $_GET['id'];
$fechaInicio = $_GET['fechaInicio'];
$fechaFin = $_GET['fechaFin'];
/*
$ID_usuario = 45;
$fechaInicio = "2023-12-12";
$fechaFin = "2023-12-16";
*/


if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


$sqlUsuario = "SELECT * FROM usuarios 
WHERE ID_usuario= $ID_usuario";
$resultUsuarios = $conexion->query($sqlUsuario);


if ($resultUsuarios) {
    // Verificar si se encontraron resultados en la consulta
    if ($resultUsuarios->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $responseUsuarios = array();
        while ($row = $resultUsuarios->fetch_assoc()) {
            $responseUsuarios[] = $row;
        }
        $datosUsuario =    json_encode($responseUsuarios);
    } else {
        // Las credenciales son incorrectas
        echo "fallo";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}



if(  (empty($fechaInicio) || empty($fechaFin)) ) {

    $sqlGastos="SELECT saldo.*, 
    saldo.saldo AS saldo_inicial, 
    COALESCE(SUM(gastos.dinero_gastado), 0) AS total_gastos, 
    saldo.saldo - COALESCE(SUM(gastos.dinero_gastado), 0) AS nuevo_saldo
    FROM saldo
    LEFT JOIN gastos ON gastos.ID_saldo = saldo.ID_saldo
    WHERE saldo.ID_usuario = $ID_usuario  
    GROUP BY saldo.ID_saldo, saldo.saldo
    ORDER BY saldo.fecha_asignacion DESC";


}else{

    $sqlGastos = "SELECT saldo.*, 
saldo.saldo AS saldo_inicial, 
COALESCE(SUM(gastos.dinero_gastado), 0) AS total_gastos, 
saldo.saldo - COALESCE(SUM(gastos.dinero_gastado), 0) AS nuevo_saldo
FROM saldo
LEFT JOIN gastos ON gastos.ID_saldo = saldo.ID_saldo
WHERE saldo.ID_usuario = $ID_usuario  
AND saldo.fecha_asignacion BETWEEN '$fechaInicio' AND '$fechaFin'
GROUP BY saldo.ID_saldo, saldo.saldo
ORDER BY saldo.fecha_asignacion DESC";

}

/*
$sqlGastos = "SELECT saldo.*, 
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

$result = $conexion->query($sqlGastos);

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
            );

            // Consulta secundaria para obtener detalles de gastos
            $sqlDetallesGastos = "SELECT gastos.*, actividades.*, nombre_actividades.*
            FROM gastos
            JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad
            JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
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

        $datosParaMostrar = json_encode($response);
        // echo $datosParaMostrar;
    }
}


if (!empty($datosParaMostrar)) {

    if (is_array($datosParaMostrar)) {
        $datosParaMostrar = json_encode($datosParaMostrar);
    }
    $desgloseDeGastos = json_decode($datosParaMostrar, true);
}


if (!empty($datosUsuario)) {

    if (is_array($datosUsuario)) {
        $datosUsuario = json_encode($datosUsuario);
    }
    $datosMostrarUsuario = json_decode($datosUsuario, true);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF gastos</title>



    <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/bitacora/css/estilo.css" rel="stylesheet">

    <!--
    <link href="http://<?php // echo $_SERVER['HTTP_HOST'] ?>/bitacoraphp/BitacoraPHP/css/estilo.css" rel="stylesheet">
-->

</head>

<div class="contenedorImagen">
    <img src="http://hidalgo.no-ip.info:5610/bitacora/fotos/fotos_usuarios/fotoperfilusuario45.jpg" class="imagen-centrada" width="100px" height="100px">


    <br><br>

    <div class="contenedor-tabla">
        <H5 class="titulo"> INFORMACION DEL EMPLEADO </H5>
        <table class="tabla_mitad">
            <tbody>
                <?php
                if (empty($datosMostrarUsuario)) {
                    echo "No se encontraron datos";
                } else {
                    foreach ($datosMostrarUsuario as $refacciones) {
                ?>
                        <tr>
                            <td class=" fondogris     texto-izquierda">ID de usuario: </td>
                            <td><?php echo  $refacciones['ID_usuario'] ?></td>
                        </tr>

                        <tr>
                            <td class="fondogris texto-izquierda">Nombre: </td>
                            <td><?php echo  $refacciones['nombre'] ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">Correo:</td>
                            <td><?php echo  $refacciones['correo'] ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">Telefono: </td>
                            <td><?php echo  $refacciones['telefono'] ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">Puesto:</td>
                            <td><?php echo  $refacciones['permisos'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</div>



<br>
<?php
if (empty($desgloseDeGastos)) {
    echo "No se encontraron datos";
} else {
    foreach ($desgloseDeGastos as $gastos) {
?>

<div class="contenedor_gastos">

        <H4 class="texto_centrado"> DESGLOSE DE GASTOS: </H4>

        <table class="tabla_mitad">
            <tbody>
                <tr>
                    <td class="fondogris texto_centrado">Saldo asignado</td>
                    <td class="fondogris texto_centrado">Saldo gastado</td>
                    <td class="fondogris texto_centrado">Saldo restante</td>
                    <td class="fondogris texto_centrado">Fecha de asignacion</td>
                    <td class="fondogris texto_centrado">Hora de asignacion</td>
                </tr>

                <tr>
                    <td><?php echo  $gastos['saldo_inicial'] ?></td>
                    <td><?php echo  $gastos['total_gastos'] ?></td>
                    <td><?php echo  $gastos['nuevo_saldo'] ?></td>
                    <td><?php echo  $gastos['fecha_asignacion'] ?></td>
                    <td><?php echo  $gastos['hora_asignacion'] ?></td>

                </tr>
            </tbody>
        </table>
        <br>
        <table class="tabla_mitad">
            <tbody>
                <tr>
                    <td class="fondo_amarillo">Dinero gastado</td>
                    <td class="fondo_amarillo">Fecha de uso</td>
                    <td class="fondo_amarillo">Hora de uso</td>
                    <td class="fondo_amarillo">Tipo de actividad</td>
                    <td class="fondo_amarillo">Descripcion de actividad</td>
                </tr>
                <?php
                if (empty($gastos['gastos'])) {
                    echo "No se encontraron datos";
                } else {
                    foreach ($gastos['gastos'] as $desgloseGastos) {
                ?>
                        <tr>
                            <td><?php echo  $desgloseGastos['dinero_gastado'] ?></td>
                            <td><?php echo  $desgloseGastos['fecha'] ?></td>
                            <td><?php echo  $desgloseGastos['hora'] ?></td>
                            <td><?php echo  $desgloseGastos['nombre_actividad'] ?></td>
                            <td><?php echo  $desgloseGastos['descripcionActividad'] ?></td>

                        </tr>

                <?php
                    }
                }
                ?>

            </tbody>
        </table>

        </div>
        <br>
        <br>
<?php
    }
}
?>


</html>


<?php

$html = ob_get_clean();


//echo $html;


require "dompdf/autoload.inc.php";
require "dompdf/vendor/autoload.php";


use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
//tamaño carta vertical
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$x          = 270;
$y          = 750;
$text       = "Página {PAGE_NUM} de {PAGE_COUNT}";
$font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
$size       = 10;
$color      = array(0, 0, 0);
$word_space = 0.0;
$char_space = 0.0;
$angle      = 0.0;

$dompdf->getCanvas()->page_text(
    $x,
    $y,
    $text,
    $font,
    $size,
    $color,
    $word_space,
    $char_space,
    $angle
);
$dompdf->stream('Reporte.pdf', array("Attachment" => false));



?>