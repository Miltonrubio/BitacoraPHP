<?php
// URL de la API
$url = "http://tallergeorgio.hopto.org:5611/bitalaapps/controller/ControllerBitala1.php";

// Datos a enviar
$data = array(
    'opcion' => '2',
    'id_empresa' => '1'
);

// Inicializar una instancia de cURL
$curl = curl_init();

// Establecer la URL a la que se realizará la solicitud
curl_setopt($curl, CURLOPT_URL, $url);

// Indicar que es una solicitud POST
curl_setopt($curl, CURLOPT_POST, true);

// Convertir los datos en una cadena de consulta
$postData = http_build_query($data);

// Establecer los datos a enviar
curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

// Indicar que quieres recibir la respuesta en lugar de imprimir
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud cURL y obtener la respuesta
$response = curl_exec($curl);

// Verificar si hubo errores en la solicitud
if (curl_errno($curl)) {
    echo 'Error al realizar la solicitud cURL: ' . curl_error($curl);
}

// Procesar la respuesta de la API
echo $response;

// Cerrar la sesión cURL
curl_close($curl);

?>
