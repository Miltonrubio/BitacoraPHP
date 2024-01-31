<?php

ob_start();
require_once "conexion.php";

$ID_usuario = $_POST['ID_usuario'];
$listaSeleccionEncoded = $_POST['listaSeleccion'];

$listaSeleccion = json_decode($listaSeleccionEncoded, true);

//$listaSeleccion = unserialize(urldecode($_POST['listaSeleccion']));


//$listaSeleccion = unserialize(base64_decode($listaSeleccionEncoded));


// print_r($listaSeleccion);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$resultadosSaldos = array();

// Recorrer el array y ejecutar las consultas
foreach ($listaSeleccion as $elemento) {


// Consulta a la tabla nuevo_saldo para obtener los elementos específicos
$saldo_query = "SELECT * FROM nuevo_saldo WHERE ID_saldo=$elemento ORDER BY status_saldo ASC, tipo_caja ASC";
$saldo_result = $conexion->query($saldo_query);

if ($saldo_result) {
    // Obtener los datos del usuario y almacenarlos en el array de resultados
    $datosSaldos = $saldo_result->fetch_assoc();
    $resultadosSaldos[] = $datosSaldos;



} else {
    // Manejar errores si la consulta no fue exitosa
    echo "Error en la consulta: " . $conexion->error;
}

    /*

    $sqlSaldos = "SELECT 
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
WHERE saldo.ID_saldo = $elemento
ORDER BY saldo.ID_saldo DESC";

    $resultSaldos = $conexion->query($sqlSaldos);

    if ($resultSaldos) {
        // Obtener los datos del usuario y almacenarlos en el array de resultados
        $datosSaldos = $resultSaldos->fetch_assoc();
        $resultadosSaldos[] = $datosSaldos;
    } else {
        // Manejar errores si la consulta no fue exitosa
        echo "Error en la consulta: " . $conexion->error;
    }*/
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


/*
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
*/



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
    <link href="http://<?php // echo $_SERVER['HTTP_HOST'] ?>/BitacoraPHP/css/estilo.css" rel="stylesheet">
    <link href="http://<?php //echo $_SERVER['HTTP_HOST'] ?>/bitacoraphp/BitacoraPHP/css/estilo.css" rel="stylesheet">
-->
<link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/bitacoraphp/BitacoraPHP/css/estilo.css" rel="stylesheet">

</head>

<div class="contenedorImagen">
<img src="./logoAb.jpeg" class="imagen-centrada" width="100px" height="100px">

<!--
<img src="http://hidalgo.no-ip.info:5610/bitacora/fotos/fotos_usuarios/fotoperfilusuario45.jpg" class="imagen-centrada" width="100px" height="100px">
-->

    <br><br>
    <div class="contenedor-tabla">
        <h5 class="titulo">INFORMACION DEL EMPLEADO</h5>
        <table class="tabla_mitad">
            <tbody>
                <?php
                if (empty($datosMostrarUsuario)) {
                    echo "No se encontraron datos";
                } else {
                    foreach ($datosMostrarUsuario as $datosUsuario) {
                ?>
                        <tr>
                            <td class="fondogris texto-izquierda">ID de usuario: </td>
                            <td><?php echo $datosUsuario['ID_usuario']; ?></td>
                        </tr>

                        <tr>
                            <td class="fondogris texto-izquierda">Nombre: </td>
                            <td><?php echo $datosUsuario['nombre']; ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">Telefono: </td>
                            <td><?php echo $datosUsuario['telefono']; ?></td>
                        </tr>
                        <tr>
                            <td class="fondogris texto-izquierda">Puesto:</td>
                            <td><?php echo $datosUsuario['permisos']; ?> </td>
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
if (empty($resultadosSaldos)) {
    echo "No se encontraron datos";
} else {
    foreach ($resultadosSaldos as $gastos) {

        $ID_saldo_actual = $gastos['ID_saldo']; // Obtén el ID_saldo actual

        $consumos_query = "SELECT consumos.*, actividades.*, nombre_actividades.*
        FROM consumos
        INNER JOIN actividades ON consumos.ID_actividad = actividades.ID_actividad
        INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
        WHERE consumos.ID_saldo_por_caja = $ID_saldo_actual";

        $resultDetallesGastos = $conexion->query($consumos_query);

     //   $detallesGastos = array();
    

        if ($resultDetallesGastos) {
            $detallesGastos = array();
            while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                $detallesGastos[] = $rowDetallesGastos;
            }
        } else {
            // Manejar errores si la consulta no fue exitosa
            echo "Error en la consulta de detalles de gastos: " . $conexion->error;
        }




       // Consulta para obtener la suma de adiciones
       $adiciones_query = "SELECT adiciones.*, usuarios.nombre AS nombre_admin_asig
       FROM adiciones
       INNER JOIN usuarios ON adiciones.ID_admin_asig = usuarios.ID_usuario
       WHERE adiciones.ID_saldo_por_caja = $ID_saldo_actual";

   $adiciones_result = $conexion->query($adiciones_query);

 //  $detallesDepositos = array();


        if ($adiciones_result) {
            $detallesDepositos = array();
            while ($rowDetallesDepositos = $adiciones_result->fetch_assoc()) {
                $detallesDepositos[] = $rowDetallesDepositos;
            }
        } else {
            // Manejar errores si la consulta no fue exitosa
            echo "Error en la consulta de detalles de depósitos: " . $conexion->error;
        }


?>

        <div class="contenedor_gastos">

            <H4 class="texto_centrado"> RESUMEN DEL SALDO: </H4>

            <table class="tabla_mitad">
                <tbody>
                    <tr>
                        <td class="fondo_amarillo texto_centrado">Saldo asignado</td>
                        <td class="fondo_amarillo texto_centrado">Saldo gastado</td>
                        <td class="fondo_amarillo texto_centrado">Saldo restante</td>
                        <td class="fondo_amarillo texto_centrado">Saldo depositado</td>
                        <td class="fondo_amarillo texto_centrado">Fecha de asignacion</td>
                        <td class="fondo_amarillo texto_centrado">Hora de asignacion</td>
                        <td class="fondo_amarillo texto_centrado">Caja</td>
                    </tr>

                    <tr>
                        <td><?php echo  $gastos['saldo_inicial'] ?></td>
                        <td><?php echo  $gastos['total_dinero_gastado'] ?></td>
                        <td><?php echo  $gastos['nuevo_saldo'] ?></td>
                        <td><?php echo  $gastos['total_dinero_agregado'] ?></td>
                        <td><?php echo  $gastos['fecha_asignacion'] ?></td>
                        <td><?php echo  $gastos['hora_asignacion'] ?></td>
                        <td><?php echo  $gastos['caja'] ?></td>

                    </tr>
                </tbody>
            </table>

            <?php


            if (!empty($detallesDepositos)) {

            ?>
                <H5 class="texto_centrado"> SALDOS AGREGADOS </H5>
                <table class="tabla_mitad">
                    <tbody>
                        <tr>
                            <td class="fondogris texto_centrado">Saldo agregado</td>
                            <td class="fondogris">Fecha</td>
                            <td class="fondogris">Hora</td>
                            <td class="fondogris">Persona que asignó</td>
                        </tr>

                        <?php
                        foreach ($detallesDepositos as $desgloseDepositos) {
                        ?>
  <tr>
                            <td class="texto_verde texto_centrado"><?php echo " + " . $desgloseDepositos['saldo_agregado'] . " $" ?></td>
                            <td><?php echo  $desgloseDepositos['fecha'] ?></td>
                            <td><?php echo  $desgloseDepositos['hora'] ?></td>
                            <td><?php echo  $desgloseDepositos['nombre_admin_asig'] ?></td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            <?php
            }
            ?>
            <H5 class="texto_centrado"> DESGLOSE DE GASTOS: </H5>
            <table class="tabla_mitad">
                <tbody>
                    <tr>
                        <td class="fondogris texto_centrado">Saldo</td>
                        <td class="fondogris">Fecha</td>
                        <td class="fondogris">Hora</td>
                        <td class="fondogris">Tipo de actividad</td>
                        <td class="fondogris">Descripcion</td>
                        <td class="fondogris">Caja</td>
                    </tr>
                    <?php
                    if (!empty($detallesGastos)) {
                        foreach ($detallesGastos as $detalleGasto) {
                    ?>
                            <tr>
                                <td class="texto_rojo texto_centrado"> <?php echo " - " . $detalleGasto['dinero_gastado'] . " $"; ?> </td>
                                <td><?php echo  $detalleGasto['fecha'] ?></td>
                                <td><?php echo  $detalleGasto['hora'] ?></td>
                                <td><?php echo  $detalleGasto['nombre_actividad'];    ?> </td>
                                <td><?php echo $detalleGasto['descripcionActividad']; ?></td>
                                <td><?php echo  $detalleGasto['tipo_caja'] ?></td>
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