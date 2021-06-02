<?php
/**
 * @param {string} origin "lat,lng"
 * @param {string} type
 * @return {string} time
 */

//get api key
$key = file_get_contents("apikey.txt", true);
$fp = new FindPlace();
$dm = new DistanceMatrix();

$fp->curl($_GET['origin'], $_GET['type']);
$destination = $fp->getLat().",".$fp->getLng();
$dm->curl($_GET['origin'], $destination);
return $dm->getDuration();