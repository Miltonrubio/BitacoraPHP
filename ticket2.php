<?php

# Incluyendo librerias necesarias #
require "./code128.php";


require_once "conexion.php";

$ID_usuario = $_POST['ID_usuario'];
$ID_encargado = $_POST['ID_encargado'];
$listaSeleccionEncoded = $_POST['listaSeleccion'];


$sqlUsuario = "SELECT * FROM usuarios 
WHERE ID_usuario= $ID_usuario";
$resultUsuarios = $conexion->query($sqlUsuario);



foreach ($listaSeleccion as $elemento) {
    $resultadosSaldos = array();
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
$pdf->Ln(3);



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
