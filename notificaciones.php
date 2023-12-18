<?php

$serverKey = 'AAAAw189fFA:APA91bGcuc07qIZOK9pMiJt_pa-VBBi0sskU9vU3DRohluo2Jd1N2v0-eZdBtWvyqD-CuXBSEAm-n7nDQilh5v6GgiOfdD_Bd-HUGBUcluf9ChvdcfSrzyuiWZu6I-BMxfOcRMJkMVPQ';

$TokenFIREBASE = $_POST["TokenFIREBASE"];
$TituloMensaje = $_POST["TituloMensaje"];
$CuerpoMensaje = $_POST["CuerpoMensaje"];

$message = [
    'title' => $TituloMensaje,
    'body' => $CuerpoMensaje,
];

$data = [
    'notification' => $message,
    'to' => $TokenFIREBASE,
];

$options = [
    CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: key=' . $serverKey,
    ],
    CURLOPT_POSTFIELDS => json_encode($data),
];

$ch = curl_init();
curl_setopt_array($ch, $options);
$result = curl_exec($ch);

if ($result === FALSE) {
    // Manejar el error
    echo 'Error al enviar la notificación.';
} else {
    // Procesar la respuesta
    echo 'Notificación enviada correctamente.';
}

curl_close($ch);

?>
