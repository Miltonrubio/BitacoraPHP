<?php

ob_start();

require_once "conexion.php";


$ID_usuario = $_GET['id'];


$rango = $_GET['rango'];


if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


$sqlUsuario = "SELECT * FROM usuarios 
WHERE ID_usuario= $ID_usuario";
$resultUsuarios = $conexion->query($sqlUsuario);

if ($resultUsuarios) {
    if ($resultUsuarios->num_rows > 0) {
        $responseUsuarios = array();
        while ($row = $resultUsuarios->fetch_assoc()) {
            $responseUsuarios[] = $row;
        }
        $datosUsuario =    json_encode($responseUsuarios);
    } else {
        echo "fallo";
    }
} else {
    echo "Error en la consulta: " . $conexion->error;
}


if ($rango == "hoy") {
    $sqlActividades = "SELECT *
    FROM actividades
    INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
    INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario
    WHERE actividades.ID_usuario = $ID_usuario
      AND DATE(actividades.fecha_inicio) = CURDATE()
    ORDER BY COALESCE(actividades.fecha_inicio, '9999-12-31') DESC";
} else if ($rango == "semana") {

    $sqlActividades = "SELECT *
    FROM actividades
    INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
    INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario
    WHERE actividades.ID_usuario = $ID_usuario
      AND actividades.fecha_inicio >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    ORDER BY COALESCE(actividades.fecha_inicio, '9999-12-31') DESC";
} else if ($rango == "mes") {

    $sqlActividades = "SELECT *
    FROM actividades
    INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
    INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario
    WHERE actividades.ID_usuario = $ID_usuario
      AND actividades.fecha_inicio >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
    ORDER BY COALESCE(actividades.fecha_inicio, '9999-12-31') DESC";
} else {
    $sqlActividades = " SELECT *
FROM actividades
INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario
WHERE actividades.ID_usuario = $ID_usuario
  AND YEAR(actividades.fecha_inicio) = YEAR(CURDATE())
ORDER BY COALESCE(actividades.fecha_inicio, '9999-12-31') DESC";
}



/*

$sqlActividades = "SELECT * FROM actividades INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad 
INNER JOIN usuarios ON actividades.ID_usuario = usuarios.ID_usuario WHERE actividades.ID_usuario = $ID_usuario 
ORDER BY COALESCE(actividades.fecha_inicio, '9999-12-31') DESC";
*/

$resultActividades = $conexion->query($sqlActividades);
if ($resultActividades) {
    if ($resultActividades->num_rows > 0) {
        $responseActividades = array();
        while ($row = $resultActividades->fetch_assoc()) {
            $responseActividades[] = $row;
        }
        $datosActividades =    json_encode($responseActividades);
    } else {
        echo "fallo";
    }
} else {
    echo "Error en la consulta: " . $conexion->error;
}




if (!empty($datosActividades)) {

    if (is_array($datosActividades)) {
        $datosActividades = json_encode($datosActividades);
    }
    $datosMostrarActividades = json_decode($datosActividades, true);
}





if (!empty($datosUsuario)) {

    if (is_array($datosUsuario)) {
        $datosUsuario = json_encode($datosUsuario);
    }
    $datosMostrarUsuario = json_decode($datosUsuario, true);
}


?>

<!DOCTYPE html>
<html lang="es_ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF actividades</title>



    <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/bitacora/css/estilo.css" rel="stylesheet">
    
    <?php
    /*
    <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/bitacoraphp/BitacoraPHP/css/estilo.css" rel="stylesheet">

    */
    ?>
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
                    echo "No se encontrò el usuario";
                } else {
                    foreach ($datosMostrarUsuario as $empleado) {
                ?>
                        <tr>
                            <td class="fondogris  texto-izquierda">ID: </td>
                            <td><?php echo  $empleado['ID_usuario'] ?></td>
                        </tr>

                        <tr>
                            <td class="fondogris texto-izquierda">NOMBRE: </td>
                            <td><?php echo  $empleado['nombre'] ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">TELEFONO: </td>
                            <td><?php echo  $empleado['telefono'] ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">PUESTO:</td>
                            <td><?php echo  $empleado['permisos'] ?> </td>
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

<H4 class="texto_centrado"> Actividades de <?php
                                            echo $datosMostrarUsuario[0]['nombre'];  ?>: </H4>

<br>
<table class="tabla_mitad">
    <tbody>
        <tr>
            <td class="fondo_amarillo texto_centrado">Nombre de Actividad</td>
            <td class="fondo_amarillo texto_centrado">Descripción</td>
            <td class="fondo_amarillo texto_centrado">Fecha de inicio </td>
            <td class="fondo_amarillo texto_centrado">Fecha de finalización</td>
            <td class="fondo_amarillo texto_centrado">Tiempo de actividad</td>
        </tr>
        <?php
        if (empty($datosMostrarActividades)) {
            echo "No se encontraron actividades";
        } else {
            foreach ($datosMostrarActividades as $actividades) {

                $fechaInicio = new DateTime($actividades['fecha_inicio']);
                $fechaFin = new DateTime($actividades['fecha_fin']);

                setlocale(LC_TIME, 'es_ES.utf8');

                $meses_en_ingles = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                $meses_en_espanol = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

                $fechaFormateadaInicio = $fechaInicio->format('d \d\e F \d\e Y \a \l\a\s g:i a');

                // Reemplazar los nombres de los meses en inglés por los correspondientes en español
                $fechaFormateadaInicio = str_replace($meses_en_ingles, $meses_en_espanol, $fechaFormateadaInicio);

                $fechaFormateadaFin = $fechaFin->format('d \d\e F \d\e Y \a \l\a\s g:i a');

                // Reemplazar los nombres de los meses en inglés por los correspondientes en español
                $fechaFormateadaFin = str_replace($meses_en_ingles, $meses_en_espanol, $fechaFormateadaFin);





                $sumaDiferencia = '';

                $diferencia = $fechaInicio->diff($fechaFin);

                $dias = $diferencia->days;
                $horas = $diferencia->h;
                $minutos = $diferencia->i;
                $segundos = $diferencia->s;

                if ($dias > 0) {
                    $sumaDiferencia .= "$dias días, ";
                }
                if ($horas > 0) {
                    $sumaDiferencia .= "$horas horas, ";
                }
                if ($minutos > 0) {
                    $sumaDiferencia .= "$minutos minutos, ";
                }
                if ($segundos > 0 || empty($sumaDiferencia)) {
                    $sumaDiferencia .= "$segundos segundos";
                }
        ?>
                <tr>
                    <td class="texto_centrado "><?php echo $actividades['nombre_actividad'] ?></td>
                    <td class="texto_centrado "><?php echo $actividades['descripcionActividad'] ?></td>

                    <?php

                    if ($actividades['estadoActividad'] != "Pendiente") {
                    ?>

                        <td class="texto_centrado"><?php echo "Iniciado el " . $fechaFormateadaInicio; ?></td>

                    <?php
                    } else {    
                    ?>
                        <td class="texto_centrado"><?php echo "Aun no se ha iniciado la actividad" ?></td>

                    <?php
                    }


                    if ($actividades['estadoActividad'] == "Finalizado") {
                    ?>

                        <td class="texto_centrado "><?php echo "Finalizado el " . $fechaFormateadaFin; ?></td>
                    <?php
                    } else if ($actividades['estadoActividad'] == "Cancelado") {

                    ?>

                        <td class="texto_centrado texto_rojo"><?php echo "Cancelado el " . $fechaFormateadaFin; ?></td>
                    <?php
                    } else { ?>

                        <td class="texto_centrado ">Aun no se ha finalizado la actividad</td>

                    <?php

                    }

                    ?>




                    <?php

                    if ($actividades['estadoActividad'] == "Finalizado") {
                    ?>

                        <td class="texto_centrado "><?php echo  $sumaDiferencia; ?></td>
                    <?php
                    } else if ($actividades['estadoActividad'] == "Cancelado") {

                    ?>

                        <td class="texto_centrado"><?php echo "Motivo de cancelación: " . $actividades['motivocancelacion'] ?></td>
                    <?php
                    } else { ?>

                        <td class="texto_centrado ">Aun no se ha finalizado la actividad</td>

                    <?php

                    }

                    ?>

                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<br>

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