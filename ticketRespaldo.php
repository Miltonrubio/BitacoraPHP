<?php

# Incluyendo librerias necesarias #
require "./code128.php";


require_once "conexion.php";

//  $ID_usuario = $_POST['ID_usuario'];
//   $listaSeleccionEncoded = $_POST['listaSeleccion'];

//  $listaSeleccion = json_decode($listaSeleccionEncoded, true);

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



$ID_usuario = 45;

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



$ID_encargado = 42;
$sqlEncargado = "SELECT * FROM usuarios 
WHERE ID_usuario= $ID_encargado";
$resultEncargado= $conexion->query($sqlEncargado);


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
$pdf->SetMargins(4, 10, 4);
$pdf->AddPage();

# Encabezado y datos de la empresa #
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("ABARROTERA HIDALGO")), 0, 'C', false);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Dirección: 5 Ote 1500,"), 0, 'C', false);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "La Purísima, 75784 "), 0, 'C', false);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Tehuacán, Pue"), 0, 'C', false);

$pdf->Ln(1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(5);

$pdf->MultiCell(0, 5, "Fecha: " . date("d/m/Y h:i A"), 0, 'C', false);



if (!empty($datosMostrarEncargado)) {
    foreach ($datosMostrarEncargado as $Encargado) {
        $nombre = $Encargado['nombre']; 
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Encargado: ".$nombre), 0, 'C', false);

    }
} else{
        
    echo "No se encontraron datos";
    }

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', '', 9);

$pdf->Ln(1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(5);

if (!empty($datosMostrarUsuario)) {
    foreach ($datosMostrarUsuario as $datosUsuario) {
        $nombre = $datosUsuario['nombre']; 
        $telefono = $datosUsuario['telefono']; 

        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Cliente: " . $nombre), 0, 'C', false);
        $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Teléfono: " . $telefono), 0, 'C', false);
    }
} else {
    echo "No se encontraron datos";
}

$pdf->Ln(1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(3);

# Tabla de productos #
$pdf->Cell(14, 5, iconv("UTF-8", "ISO-8859-1", "Caja."), 0, 0, 'C');
$pdf->Cell(19, 5, iconv("UTF-8", "ISO-8859-1", "Saldo"), 0, 0, 'C');
$pdf->Cell(19, 5, iconv("UTF-8", "ISO-8859-1", "Asignacion"), 0, 0, 'C');
//$pdf->Cell(28, 5, iconv("UTF-8", "ISO-8859-1", "Total"), 0, 0, 'C');

$pdf->Ln(3);
$pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
$pdf->Ln(3);



/*----------  Detalles de la tabla  ----------*/
//$pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", "Nombre de producto a vender"), 0, 'C', false);
$pdf->Cell(14, 4, iconv("UTF-8", "ISO-8859-1", "Capital"), 0, 0, 'C');
$pdf->Cell(19, 4, iconv("UTF-8", "ISO-8859-1", "1200 $"), 0, 0, 'C');
$pdf->Cell(19, 4, iconv("UTF-8", "ISO-8859-1", "10 enero 2024"), 0, 0, 'C');
//$pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "$70.00 USD"), 0, 0, 'C');
$pdf->Ln(4);
/*----------  Fin Detalles de la tabla  ----------*/


/*

$pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

$pdf->Ln(5);

# Impuestos & totales #
$pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
$pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL"), 0, 0, 'C');
$pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "+ 1230.00 $"), 0, 0, 'C');

$pdf->Ln(5);

$pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
$pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "RESTANTE: "), 0, 0, 'C');
$pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "+ 0.00 $"), 0, 0, 'C');

$pdf->Ln(5);

*/

$pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

$pdf->Ln(5);

$pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
$pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL DE CAJA GASTOS:"), 0, 0, 'C');
$pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "70.00 $"), 0, 0, 'C');

$pdf->Ln(5);

$pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
$pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "RESTANTE CAJA GASTOS:"), 0, 0, 'C');
$pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "100.00 $"), 0, 0, 'C');

$pdf->Ln(5);

$pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
$pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL DE CAJA CAPITAL:"), 0, 0, 'C');
$pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "300.00 $"), 0, 0, 'C');

$pdf->Ln(5);

$pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
$pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "RESTANTE CAJA CAPITAL:"), 0, 0, 'C');
$pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "0.00 $"), 0, 0, 'C');

$pdf->Ln(10);

$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 'C', false);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", "Nombre del empleado"), '', 0, 'C');

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
