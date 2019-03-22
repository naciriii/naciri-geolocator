<?php
include ("../vendor/autoload.php");


use Naciri\Geolocator\Geolocator;

$g = new Geolocator(new GuzzleHttp\Client);
try {
$d = $g->getAddressFromCoords("hello", 9.537499);
} catch(Exception $e) {
	var_dump($e);
}
var_dump($d);