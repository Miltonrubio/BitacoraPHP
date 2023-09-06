<?php
function sendNotification($deviceTokens, $title, $body) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $serverKey = 'AAAAEsiu4jo:APA91bFqWVejamLHfdtJJlK3KhKeF-Ly4tbSMK2Yq-xrxfsUPA_Qw3EVQgI9pM6wfWzJ9yPlNLs6vbJyUFlZ7kWEWi1_W9X4i2X0dQUEeEBqmhYJalokOh19ErhfAkf7KOgEv2nXRt_e';

    $data = array(
        'registration_ids' => $deviceTokens,
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




?>
