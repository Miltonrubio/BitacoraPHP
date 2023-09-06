<?php

require "vendor/autoload.php";

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Notification;


$serverKey = 'AAAAh3zXfyQ:APA91bGKWNEPrU8TsdU4We1hKgAEXGI15rLfYeK2bZ4GxGZqpQdA5jS5m9l6IhHIfSSSNjaDanQ3vQnBYie3KCQXsNm_raCJ3dKdQ_kWThBS7k9FggZm0SA-BhxOi1fnUONQU9IO2g8y';
$client = new Client();
$client->setApiKey($serverKey);
$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());


$message = new Message();
$message->setPriority('high');
$message->setNotification(new Notification("Titulo", "Mensaje", "default"))
    ->setData(['key' => 'value']);


$api_url = "http://tallergeorgio.hopto.org:5611/georgioapp/georgioapi/Controllers/Apiback.php";

$data = array(
    'opcion' => "5"
);

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);

if ($response === false) {
    echo "Error en la solicitud cURL: " . curl_error($ch);
} else {
    $response_array = json_decode($response, true); // Decodificar la respuesta JSON en un array asociativo

    $tokens = array(); // Array para almacenar los tokens

    foreach ($response_array as $user) {
        if (isset($user["token"])) {
            $tokens[] = $user["token"]; // Almacena el token en el array
        }
    }

    if (!empty($tokens)) {
        // Aquí toma los datos de $tokens[] y los mete en $deviceTokens
        $deviceTokens = $tokens;

    
        foreach ($deviceTokens as $clientToken) {
            $message->addRecipient(new Device($clientToken));
        }

        // Enviar el mensaje a los dispositivos
        $response = $client->send($message);
        var_dump($response->getStatusCode());
        var_dump($response->getBody()->getContents());
    } else {
        echo "No se pudo obtener ningún token desde la respuesta.";
    }
}

curl_close($ch);
?>
