<?php
//get api key
$key = file_get_contents("apikey.txt", true);

echo json_encode(getNearestPlace($_GET['latlng'], $_GET['type'], $key));

function getNearestPlace($latlng, $input, $key) {
    $fields = ["name", "geometry", "place_id"];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=$input&inputtype=textquery&fields=".implode(",", $fields)."&locationbias=point:$latlng&key=$key",
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
    $res = array(
        "name" => $response['candidates'][0]['name'],
        "place_id" => $response['candidates'][0]['place_id'],
        "lat" => $response['candidates'][0]['geometry']['location']['lat'],
        "lng" => $response['candidates'][0]['geometry']['location']['lng'],
    );
    return $res;
}