<?php
$input = "Leven Street, Meadows";
$input = str_replace(" ", "+", $input);

//please don't steal my key :(
$key = "AIzaSyAW1tWGyv2Oufto9amzILG5lCBAWSO7x3o";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?key=$key&address=$input",
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
// var_dump($response["results"][0]["geometry"]["location"]["lat"]);
// exit();
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

$input = $response["result"][0]["postcode"];

include "getsimd.php";