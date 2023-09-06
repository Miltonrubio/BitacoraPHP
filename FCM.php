<?php

require_once "conexion.php";

require "vendor/autoload.php";

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Notification;

$serverKey = 'AAAAEsiu4jo:APA91bFqWVejamLHfdtJJlK3KhKeF-Ly4tbSMK2Yq-xrxfsUPA_Qw3EVQgI9pM6wfWzJ9yPlNLs6vbJyUFlZ7kWEWi1_W9X4i2X0dQUEeEBqmhYJalokOh19ErhfAkf7KOgEv2nXRt_e';

$client = new Client();
$client->setApiKey($serverKey);
$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

$message = new Message();
$message->setPriority('high');
$message->setNotification(new Notification('Prueba desde PHP con BD', "Todo correcto nuevamente ;)", "default"))
    ->setData(['key' => 'value']);

// Obtener los tokens de dispositivos desde la base de datos
$consulta_tokens = "SELECT Token FROM notificaciones";
$resultado_tokens = $conexion->query($consulta_tokens);

if ($resultado_tokens) {
    $deviceTokens = array();
    while ($fila = $resultado_tokens->fetch_assoc()) {
        $deviceTokens[] = $fila["Token"];
    }

    foreach ($deviceTokens as $clientToken) {
        $message->addRecipient(new Device($clientToken));
    }

    // Enviar el mensaje a los dispositivos
    $response = $client->send($message);
    var_dump($response->getStatusCode());
    var_dump($response->getBody()->getContents());
} else {
    echo "Error al obtener los tokens de dispositivos: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();

?>
