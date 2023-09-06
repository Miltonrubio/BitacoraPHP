<?php
$curl = curl_init();


$data = array(
    'opcion' => '9',
    'idventa' => '60', 
);
   
$imagePath = './src/dino.jpeg';
$data['image'] = new CURLFile($imagePath);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.1.252/georgioapi/Controllers/Apiback.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Error: ' . curl_error($curl);
} else {
    echo 'Response: ' . $response;
}

curl_close($curl);
?>
