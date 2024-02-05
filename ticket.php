<?php

# Incluyendo librerias necesarias #
require "./code128.php";

//Habilitar la depuraciòn de errores
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "conexion.php";

$ID_usuario = $_POST['ID_usuario'];
$ID_encargado = $_POST['ID_encargado'];
$listaSeleccionEncoded = $_POST['listaSeleccion'];

$listaSeleccion = json_decode($listaSeleccionEncoded, true);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


$resultadosSaldos = array();
foreach ($listaSeleccion as $elemento) {
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



$sqlEncargado = "SELECT * FROM usuarios 
WHERE ID_usuario= $ID_encargado";
$resultEncargado = $conexion->query($sqlEncargado);


if ($resultEncargado) {
    // Verificar si se encontraron resultados en la consulta
    if ($resultEncargado->num_rows > 0) {
        // El usuario y la contraseña son válidos
        $responseEncargado = array();
        while ($row = $resultEncargado->fetch_assoc()) {
            $responseEncargado[] = $row;
        }
        $datosEncargado =    json_encode($responseEncargado);
    } else {
        // Las credenciales son incorrectas
        echo "fallo";
    }
} else {
    // Error en la consulta SQL
    echo "Error en la consulta: " . $conexion->error;
}



if (!empty($datosUsuario)) {

    if (is_array($datosUsuario)) {
        $datosUsuario = json_encode($datosUsuario);
    }
    $datosMostrarUsuario = json_decode($datosUsuario, true);
}


if (!empty($datosEncargado)) {

    if (is_array($datosEncargado)) {
        $datosEncargado = json_encode($datosEncargado);
    }
    $datosMostrarEncargado = json_decode($datosEncargado, true);
}


$pdf = new PDF_Code128('P', 'mm', array(80, 258));

$pdf->SetMargins(4, 6, 4);
$pdf->AddPage();

# Encabezado y datos de la empresa #
$pageWidth = $pdf->GetPageWidth();

$imageWidth = 20; // Adjust this based on the actual width of your image

// Calculate the X-coordinate to center the image
$imageX = ($pageWidth - $imageWidth) / 2;
$pdf->Ln(1);
// Draw the image first
$pdf->Image('logoAb.png', $imageX, 5, 20, 20, 'png');
$pdf->Ln(22);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(0, 0, 0);
//$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("ABARROTERA HIDALGO")), 0, 'C', false);


$pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " 5 Ote 1500, La Purísima, 75784 Tehuacán, Pue."), 0, 'C', false);
//$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "La Purísima, 75784 "), 0, 'C', false);
//$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Tehuacán, Pue"), 0, 'C', false);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(2);

// Obtener la posición Y actual
$posicionYEncargado = $pdf->GetY();

if (!empty($datosMostrarEncargado)) {
    foreach ($datosMostrarEncargado as $Encargado) {
        $nombreEncargado = $Encargado['nombre'];
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Encargado: " . $nombreEncargado), 0, 'L', false);
    }
} else {
    echo "No se encontraron datos";
}

// Obtener la posición Y después de imprimir "Encargado"
$posicionYFecha = $pdf->GetY();

// Establecer la posición Y de la fecha para que coincida con la posición Y de "Encargado"
$pdf->SetY($posicionYEncargado);

$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Fecha: " . date("d/m/Y")), 0, 1, 'R');

// Mostrar solo la hora
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Hora: " . date("h:i A")), 0, 1, 'R');


//$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', '', 9);

$pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(3);

$pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", strtoupper("INFORMACIÓN DEL EMPLEADO")), 0, 'C', false);



$posicionYNombreEmpleado = $pdf->GetY();

if (!empty($datosMostrarUsuario)) {
    foreach ($datosMostrarUsuario as $datosUsuario) {
        $nombreEmpleado = $datosUsuario['nombre'];
        $telefono = $datosUsuario['telefono'];
        $permisos = $datosUsuario['permisos'];


        $pdf->SetY($posicionYNombreEmpleado);
        $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Nombre: " . $nombreEmpleado), 0, 1, 'L');
        $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Puesto: " . $permisos), 0, 1, 'L');
        $pdf->Ln(2);

        $posicionYTelefono = $pdf->GetY();
        $pdf->SetY($posicionYNombreEmpleado);

        $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Cel: " . $telefono), 0, 1, 'R');
        $pdf->Ln(2);
    }
} else {
    echo "No se encontraron datos";
}

$pdf->Ln(2);



if (!empty($resultadosSaldos)) {
    foreach ($resultadosSaldos as $gastos) {

        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(1);

        $ID_saldo_actual = $gastos['ID_saldo']; // Obtén el ID_saldo actual
        $caja =    $gastos['tipo_caja'];
        $hora_asignacion =    $gastos['hora_asignacion_saldo'];
        $fecha_asignacion =    $gastos['fecha_asignacion_saldo'];
        $saldo_asignado =    $gastos['saldo_asignado'];

        $consumos_query = "SELECT consumos.*, actividades.*, nombre_actividades.*
        FROM consumos
        INNER JOIN actividades ON consumos.ID_actividad = actividades.ID_actividad
        INNER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad
        WHERE consumos.ID_saldo_por_caja = $ID_saldo_actual";

        $resultDetallesGastos = $conexion->query($consumos_query);

        $detallesGastos = array();
        if ($resultDetallesGastos) {
            while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                $detallesGastos[] = $rowDetallesGastos;
            }
        } else {
            echo "Error en la consulta de detalles de gastos: " . $conexion->error;
        }

        $adiciones_query = "SELECT adiciones.*, usuarios.nombre AS nombre_admin_asig
        FROM adiciones
        INNER JOIN usuarios ON adiciones.ID_admin_asig = usuarios.ID_usuario
        WHERE adiciones.ID_saldo_por_caja = $ID_saldo_actual";

        $adiciones_result = $conexion->query($adiciones_query);

        if ($adiciones_result) {
            $detallesDepositos = array();
            while ($rowDetallesDepositos = $adiciones_result->fetch_assoc()) {
                $detallesDepositos[] = $rowDetallesDepositos;
            }
        } else {
            // Manejar errores si la consulta no fue exitosa
            echo "Error en la consulta de detalles de depósitos: " . $conexion->error;
        }



        $saldo_restante = $saldo_asignado + array_sum(array_column($detallesDepositos, 'saldo_agregado')) - array_sum(array_column($detallesGastos, 'dinero_gastado'));

        // Calcular el total de adiciones
        $total_adiciones = array_sum(array_column($detallesDepositos, 'saldo_agregado'));

        // Calcular el total de consumos
        $total_consumos = array_sum(array_column($detallesGastos, 'dinero_gastado'));


        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "SALDO  DE CAJA: " . strtoupper($caja)), 0, 0, 'C');

        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln(4);
        if (!empty($detallesGastos)) {
            foreach ($detallesGastos as $detalleGasto) {


                $fecha =    $detalleGasto['fecha'];
                $hora =    $detalleGasto['hora'];
                $dinero_gastado =    $detalleGasto['dinero_gastado'];
                $nombre_actividad =    $detalleGasto['nombre_actividad'];
                $descripcionActividad =    $detalleGasto['descripcionActividad'];

                $posicionYGastos = $pdf->GetY();

                $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", "Asignacion: " . $fecha . " " . $hora), 0, 'L', false);
                $pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", $descripcionActividad), 0, 'L', false);


                $posicionYSaldoGastado = $pdf->GetY();
                $pdf->SetY($posicionYGastos);


                $pdf->SetFont('Arial', 'B', 10);

                $pdf->MultiCell(0, 8, iconv("UTF-8", "ISO-8859-1", strtoupper("$ " . $dinero_gastado)), 0, 'R', false);

                $pdf->SetFont('Arial', '', 9);

                $pdf->Ln(2);
            }
        } else {
        }
        $pdf->Ln(2);

        if (!empty($detallesDepositos)) {
            //$pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", "Nombre de producto a vender"), 0, 'C', false);
            $pdf->Cell(25, 4, iconv("UTF-8", "ISO-8859-1", "Saldo agregado "), 0, 0, 'C');
            $pdf->Cell(9, 4, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
            $pdf->Cell(30, 4, iconv("UTF-8", "ISO-8859-1", "Fecha de asignación"), 0, 0, 'C');


            foreach ($detallesDepositos as $desgloseDepositos) {

                $fecha =    $desgloseDepositos['fecha'];
                $hora =    $desgloseDepositos['hora'];
                $dinero_agregado =    $desgloseDepositos['saldo_agregado'];
                //  $tipo_caja =    $desgloseDepositos['tipo_caja'];


                $pdf->Ln(2);
                $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
                $pdf->Ln(3);
                $pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "+ " . $dinero_agregado), 0, 0, 'C');
                $pdf->Cell(37, 4, iconv("UTF-8", "ISO-8859-1", $fecha . "        " . $hora), 0, 0, 'C');
                //$pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "$70.00 USD"), 0, 0, 'C');

            }
        } else {
        }

        $pdf->Ln(2);



        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFont('Arial', '', 8);



        $pdf->Ln(2);

        $pdf->SetFont('Arial', '', 9);


        $pdf->Ln(5);
        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');

        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "SALDO TOTAL: "), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", " $ " . ($saldo_asignado + $total_adiciones)), 0, 0, 'R');

        $pdf->SetFont('Arial', '', 9);

      
        if (!empty($detallesDepositos)) {

            $pdf->Ln(5);
            $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
    
            $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "SALDO ASIGNADO: "), 0, 0, 'L');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", " $ " . $saldo_asignado), 0, 0, 'R');


            $pdf->SetFont('Arial', '', 9);
            $pdf->Ln(5);
            $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
            $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL DE ADICIONES: "), 0, 0, 'L');
            $pdf->SetFont('Arial', 'B', 9);

            $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", " $ " . $total_adiciones), 0, 0, 'R');
        } else {
        }
        $pdf->SetFont('Arial', '', 9);


        $pdf->Ln(5);
        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL DE GASTOS: "), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);


        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", " $ " . $total_consumos), 0, 0, 'R');


        $pdf->SetFont('Arial', '', 9);



        $pdf->Ln(5);

        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "SOBRANTE:"), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", " $ " . $saldo_restante), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 9);

        $pdf->Ln(2);

        $pdf->Ln(7);
    }
} else {
    echo   "No se encontraron resultados";
}

$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 'C', false);

$pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", $nombreEmpleado), '', 0, 'C');

/*
    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),"COD000001V0001",70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);
  */

# Nombre del archivo PDF #
$pdf->Output("I", "Ticket_Nro_1.pdf", true);
