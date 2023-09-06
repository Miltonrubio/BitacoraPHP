<?php
function sendNotification($deviceToken, $title, $body) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $serverKey = 'AAAAh3zXfyQ:APA91bGKWNEPrU8TsdU4We1hKgAEXGI15rLfYeK2bZ4GxGZqpQdA5jS5m9l6IhHIfSSSNjaDanQ3vQnBYie3KCQXsNm_raCJ3dKdQ_kWThBS7k9FggZm0SA-BhxOi1fnUONQU9IO2g8y';
    $data = array(
        'to' => $deviceToken,
        'notification' => array(
            'title' => $title,
            'body' => $body,
        ),
    );

    $headers = array(
        'Authorization: key=' . $serverKey,
        'Content-Type: application/json',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Usage example
$deviceToken = 'e4OGySmrQNWh5Ihhi7cHeM:APA91bFYQBkuPBIz_l7zZJ92B5IK0-iCBJHL8hQjDpgXvS_GrGaxdLHDKA2T8XnqoqTjr2e0XsoXkqOYaeXyApPdVf4ynN8nJU-MHG0eVjfNiF_TibtOkSiL2yo6-D3s3Ypim1M4R74t';
$title = 'Notificacion desde PHP';
$body = 'Ola soy una notificacion de php jeje';

$response = sendNotification($deviceToken, $title, $body);
echo 'FCM Notification Response: ' . $response;
?>
