[![Build Status](https://travis-ci.com/naciriii/naciri-geolocator.svg?branch=master)](https://travis-ci.com/naciriii/naciri-geolocator)
# naciri-geolocator
This Module simplifies the resolution of an address to google coordinates (lat /lng) and vice versa.


## Installation
This Module assumes you have composer installed and autolaod configured. Simply clone this repository

## Usage
Add your google API key into /config/Geocoder.php under 

       [

      "API_TOKEN" => "YOUR-GOOGLE-API-TOKEN-GOES-HERE"
       ];

Import the Module 
  
    use Naciri\Geolocator\Geolocator;
Initialize a Http client instance (Guzzle)  

    $geolocator = new Geolocator($client);
To get Coordinates from an address use getAddressFromCoords method and It will return an object containing lat/lng and specified address

    /**
    $responseObject->address Specified Address
    $responseObject->lat Precise Latitude 
    $responseObject->lng Precise Longitude
    **/
    $responseObject = $geolocator->getAddressFromCoordinates($lat, $lng);
    

To get address from coordinates use getCoordinatesFromAddress method and It will return an object containing address and specified lat/lng precisely

     /**
    $responseObject->lat Precise Latitude 
    $responseObject->lng Precise Longitude
    $responseObject->address Specified Address
    **/
    $responseObject = $geolocator->getCoordsFromAddress($address);

## Testing
To run the tests

    composer run-test tests


