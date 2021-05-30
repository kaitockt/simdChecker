<?php
include_once "includes/autoload.inc.php";
$geocode = new Geocode();
$curl = new Curl();

// $input = "Leven Street, Meadows";
$input = $_GET['addr'];
$input = str_replace(" ", "+", $input);

//get api key
$key = file_get_contents("apikey.txt", true);

if($geocode->curl($input, $key)){
    $lat = $geocode->getLat();
    $lng = $geocode->getLng();
} else {
    //TODO: error handler
    echo "Error";
}


//get post code from postcode.io
$response = $curl->run("api.postcodes.io/postcodes?lon=$lng&lat=$lat");

$_GET['pc'] = $response["result"][0]["postcode"];
$_GET['lat'] = $lat;
$_GET['lng'] = $lng;

include "getsimd.php";
