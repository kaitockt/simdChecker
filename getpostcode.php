<?php
// $input = "Leven Street, Meadows";
$input = $_GET['addr'];
$input = str_replace(" ", "+", $input);

//get api key
$key = file_get_contents("apikey.txt", true);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=$input&key=$key",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response = json_decode($response, true);
$lat = $response["results"][0]["geometry"]["location"]["lat"];
$lng = $response["results"][0]["geometry"]["location"]["lng"];

$curl2 = curl_init();
curl_setopt_array($curl2, array(
    CURLOPT_URL => "api.postcodes.io/postcodes?lon=$lng&lat=$lat",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl2);
$err = curl_error($curl2);

curl_close($curl2);
$response = json_decode($response, true);
// echo $response["result"][0]["postcode"];

$_GET['pc'] = $response["result"][0]["postcode"];

include "getsimd.php";
