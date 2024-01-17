<?php

# Incluyendo librerias necesarias #
require "./code128.php";


require_once "conexion.php";

$ID_usuario = $_POST['ID_usuario'];
$ID_encargado = $_POST['ID_encargado'];
$listaSeleccionEncoded = $_POST['listaSeleccion'];

$listaSeleccion = json_decode($listaSeleccionEncoded, true);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$resultadosSaldos = array();

// Recorrer el array y ejecutar las consultas
foreach ($listaSeleccion as $elemento) {
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
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("ABARROTERA HIDALGO")), 0, 'C', false);
$pdf->SetFont('Arial', '', 8);


$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Dirección: 5 Ote 1500,"), 0, 'C', false);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "La Purísima, 75784 "), 0, 'C', false);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Tehuacán, Pue"), 0, 'C', false);

$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(3);

$pdf->MultiCell(0, 5, "Fecha: " . date("d/m/Y h:i A"), 0, 'C', false);



if (!empty($datosMostrarEncargado)) {
    foreach ($datosMostrarEncargado as $Encargado) {
        $nombreEncargado = $Encargado['nombre'];
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Encargado: " . $nombreEncargado), 0, 'C', false);
    }
} else {

    echo "No se encontraron datos";
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', '', 9);

$pdf->Ln(1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(3);

if (!empty($datosMostrarUsuario)) {
    foreach ($datosMostrarUsuario as $datosUsuario) {
        $nombreEmpleado = $datosUsuario['nombre'];
        $telefono = $datosUsuario['telefono'];

        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Saldo de: " . $nombreEmpleado), 0, 'C', false);
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Teléfono: " . $telefono), 0, 'C', false);
    }
} else {
    echo "No se encontraron datos";
}


if (!empty($resultadosSaldos)) {
    foreach ($resultadosSaldos as $gastos) {

        $ID_saldo_actual = $gastos['ID_saldo']; // Obtén el ID_saldo actual

        $sqlDetallesGastos = "SELECT * FROM gastos 
        LEFT OUTER JOIN actividades ON gastos.ID_actividad = actividades.ID_actividad 
        LEFT OUTER JOIN nombre_actividades ON actividades.ID_nombre_actividad = nombre_actividades.ID_nombre_actividad 
        WHERE ID_saldo = $ID_saldo_actual";

        $resultDetallesGastos = $conexion->query($sqlDetallesGastos);

        if ($resultDetallesGastos) {
            $detallesGastos = array();
            while ($rowDetallesGastos = $resultDetallesGastos->fetch_assoc()) {
                $detallesGastos[] = $rowDetallesGastos;
            }
        } else {
            echo "Error en la consulta de detalles de gastos: " . $conexion->error;
        }




        $sqlDetallesDepositos = "SELECT depositos.*,
        usuarios.nombre AS nombre_admin_asig
        FROM usuarios
        JOIN depositos ON usuarios.ID_usuario = depositos.ID_admin_asig
        WHERE ID_saldo =$ID_saldo_actual";

        $resultDetallesDepositos = $conexion->query($sqlDetallesDepositos);

        if ($resultDetallesDepositos) {
            $detallesDepositos = array();
            while ($rowDetallesDepositos = $resultDetallesDepositos->fetch_assoc()) {
                $detallesDepositos[] = $rowDetallesDepositos;
            }
        } else {
            echo "Error en la consulta de detalles de depósitos: " . $conexion->error;
        }



        $pdf->Ln(1);
        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(3);


        # Tabla de productos #
        $pdf->Cell(14, 5, iconv("UTF-8", "ISO-8859-1", "Caja."), 0, 0, 'C');
        $pdf->Cell(19, 5, iconv("UTF-8", "ISO-8859-1", "Saldo"), 0, 0, 'C');
        $pdf->Cell(37, 5, iconv("UTF-8", "ISO-8859-1", "Asignacion"), 0, 0, 'C');
        //$pdf->Cell(28, 5, iconv("UTF-8", "ISO-8859-1", "Total"), 0, 0, 'C');



        $pdf->Ln(3);
        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
        $pdf->Ln(3);

        $caja =    $gastos['caja'];
        $hora_asignacion =    $gastos['hora_asignacion'];
        $fecha_asignacion =    $gastos['fecha_asignacion'];
        $saldo_inicial =    $gastos['saldo_inicial'];


        /*----------  Detalles de la tabla  ----------*/
        //$pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", "Nombre de producto a vender"), 0, 'C', false);
        $pdf->Cell(14, 4, iconv("UTF-8", "ISO-8859-1", $caja), 0, 0, 'C');
        $pdf->Cell(19, 4, iconv("UTF-8", "ISO-8859-1", $saldo_inicial), 0, 0, 'C');
        $pdf->Cell(37, 4, iconv("UTF-8", "ISO-8859-1", $fecha_asignacion . " " . $hora_asignacion), 0, 0, 'C');
        //$pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "$70.00 USD"), 0, 0, 'C');




        if (!empty($detallesDepositos)) {
            foreach ($detallesDepositos as $desgloseDepositos) {

                $fecha =    $desgloseDepositos['fecha'];
                $hora =    $desgloseDepositos['hora'];
                $dinero_agregado =    $desgloseDepositos['dinero_agregado'];
                $tipo_caja =    $desgloseDepositos['tipo_caja'];


                $pdf->Ln(2);
                $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
                $pdf->Ln(3);
                $pdf->Cell(14, 4, iconv("UTF-8", "ISO-8859-1", $tipo_caja), 0, 0, 'C');
                $pdf->Cell(19, 4, iconv("UTF-8", "ISO-8859-1", "+ " . $dinero_agregado), 0, 0, 'C');
                $pdf->Cell(37, 4, iconv("UTF-8", "ISO-8859-1", $fecha . " " . $hora), 0, 0, 'C');
                //$pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "$70.00 USD"), 0, 0, 'C');
               
            }
        } else {
        }



        if (!empty($detallesGastos)) {
            foreach ($detallesGastos as $detalleGasto) {



                $tipo_caja =    $detalleGasto['tipo_caja'];
                $fecha =    $detalleGasto['fecha'];
                $hora =    $detalleGasto['hora'];
                $dinero_gastado =    $detalleGasto['dinero_gastado'];
                $nombre_actividad =    $detalleGasto['nombre_actividad'];
                $descripcionActividad =    $detalleGasto['descripcionActividad'];
                
                $pdf->Ln(2);
                $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
                $pdf->Ln(3);
                $pdf->Cell(14, 4, iconv("UTF-8", "ISO-8859-1", $tipo_caja), 0, 0, 'C');
                $pdf->Cell(19, 4, iconv("UTF-8", "ISO-8859-1", "- " . $dinero_gastado), 0, 0, 'C');
                $pdf->Cell(37, 4, iconv("UTF-8", "ISO-8859-1", $fecha . " " . $hora), 0, 0, 'C');
                //$pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "$70.00 USD"), 0, 0, 'C');
           
                $pdf->Ln(3);    
                $pdf->SetFont('Arial', '', 10);               
                $pdf->Cell(72, 5,  iconv("UTF-8", "ISO-8859-1", $nombre_actividad), 0, 0, 'C');

                $pdf->Ln(4);   
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(72, 5,  iconv("UTF-8", "ISO-8859-1", $descripcionActividad), 0, 0, 'C');


            }
        }else{

        }

        $pdf->Ln(2);
        $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetFont('Arial', '', 8);



        $gastos_Cajagastos =    $gastos['gastos_Cajagastos'];
        $gastos_CajaCapital =    $gastos['gastos_CajaCapital'];
        $depositos_Cajagastos =    $gastos['depositos_Cajagastos'];
        $depositos_CajaCapital =    $gastos['depositos_CajaCapital'];

        $total_caja_gastos = 0;
        $total_caja_capital = 0;

        $total_saldo_gastos = 0;
        $total_saldo_capital = 0;


        if ($caja == "Capital") {

            $total_caja_capital = $saldo_inicial + $depositos_CajaCapital - $gastos_CajaCapital;
            $total_caja_gastos =  $depositos_Cajagastos - $gastos_Cajagastos;

            $total_saldo_capital = $saldo_inicial + $depositos_CajaCapital;
            $total_saldo_gastos = $depositos_Cajagastos;
        } else {

            $total_caja_capital =  $depositos_CajaCapital - $gastos_CajaCapital;
            $total_caja_gastos =  $saldo_inicial + $depositos_Cajagastos - $gastos_Cajagastos;


            $total_saldo_capital = $depositos_CajaCapital;
            $total_saldo_gastos = $saldo_inicial + $depositos_Cajagastos;
        }

        $pdf->Ln(5);
        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "SALDO TOTAL DE GASTOS: "), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", $total_saldo_gastos), 0, 0, 'C');

        $pdf->Ln(5);
        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "GASTOS CAJA GASTOS: "), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", $gastos_Cajagastos), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "RESTANTE CAJA GASTOS:"), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1",  $total_caja_gastos), 0, 0, 'C');

        $pdf->Ln(7);


        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "SALDO TOTAL DE CAPITAL: "), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", $total_saldo_capital), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "GASTOS CAJA CAPITAL:"), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", $gastos_CajaCapital), 0, 0, 'C');

        $pdf->Ln(5);

        $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
        $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "RESTANTE CAJA CAPITAL:"), 0, 0, 'C');
        $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", $total_caja_capital), 0, 0, 'C');


        $pdf->Ln(10);


        

    }
} else {
    echo   "No se encontraron resultados";
}


$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 'C', false);

$pdf->Ln(2);
$pdf->Cell(65, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", $nombreEmpleado), '', 0, 'C');

$pdf->Ln(9);

/*
    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),"COD000001V0001",70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);
  */

# Nombre del archivo PDF #
$pdf->Output("I", "Ticket_Nro_1.pdf", true);
