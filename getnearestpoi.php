<?php
/**
 * @param {string} origin "lat,lng"
 * @param {string} type
 * @return {string} time
 */

//get api key
$key = file_get_contents("apikey.txt", true);
include_once 'includes/autoload.inc.php';
$fp = new FindPlace();
$dm = new DistanceMatrix();

$fp->curl($_GET['origin'], $_GET['type']);
$destination = $fp->getLat().",".$fp->getLng();
$dm->curl($_GET['origin'], $destination);
echo json_encode($dm->getDuration());