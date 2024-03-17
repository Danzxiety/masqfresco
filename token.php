<?php


$checkout_id = $_GET['checkout_id'];


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://www.tropipay.com/api/v2/access/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'grant_type' => 'client_credentials',
    'client_id' => 'a9dd44062ebfec67b12de6bdfdc74dfc',
    'client_secret' => '9c1e6d84969924b6cc25a6c53cb7a929'
  ]),
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data = json_decode($response, true);
  $accessToken = $data['access_token'];
}

header("Location: payment.php?access_token=$accessToken&checkout_id=$checkout_id");


?>
