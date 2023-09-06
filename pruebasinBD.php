<?php






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
$message->setNotification(new Notification('Prueba desde PHP sin BD', "Todo correcto nuevamente ;)", "default"))
    ->setData(['key' => 'value']);

// Obtener los tokens de dispositivos (simulado)
$deviceTokens = [
    "cFCqt4SWSye1MhZux9Zf2Z:APA91bG811VwEf7OXnnIlw-KJtsBwvyfGIIgTq-7r2RP8nCzAmUqd6WMUDoehFxGpAeCznnY9Caag4jiHhwlK_0ZmGXpOR5KkRaa4QHdwvTzksvtEReF5tj4eml6w8UYT1Xqn7EyYike",
    "token2",
    "token3"
];

foreach ($deviceTokens as $clientToken) {
    $message->addRecipient(new Device($clientToken));
}

// Enviar el mensaje a los dispositivos
$response = $client->send($message);
var_dump($response->getStatusCode());
var_dump($response->getBody()->getContents());
?>
