<?php
include ("../vendor/autoload.php");


use Naciri\Geolocator\Geolocator;

$g = new Geolocator(new GuzzleHttp\Client);

$d = $g->getAddressFromCoords(33.886917, 9.537499);
var_dump($d);