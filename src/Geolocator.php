<?php
/**
 * Gelocator.php
 * @author    Naciriii <nnacir1938@hotmail.com
 * @copyright 2019 Nacer Nsiri
 * @see       https://github.com/naciriii/naciri-geolocator
 */

namespace Naciri\Geolocator;

class Geolocator
{

    /** @var $client HTTP client to perform requests */
    private $client;

    /** @var $googleApitoken google maps api token */
    private $googleApiToken;
    /** @var $googleApiUrl api url used to get address and coords */
    private $googleApiUrl = 'https://maps.googleapis.com/maps/api/geocode/json';

    /**
     * __construct
     * @param GuzzleHttp\ClientInterface $client Guzzle client
     */
    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
        /** @var string get google api token from config file */
      
        $this->googleApiToken = config("API_TOKEN");
    }

    public function __get($prop)
    {
        return property_exists($this, $prop) ? $this->$prop : null;
    }

    /**
     * getAddressFromCoords returns address from coordinates
     * @param  float $lat
     * @param  float $lng
     * @return Object      object of anonymous class containing lat/lng and formatted address
     */
    public function getAddressFromCoords($lat, $lng)
    {
        $response = $this->client->request(
            'get',
            $this->googleApiUrl,
            [
            "query" => [
            "key" => $this->googleApiToken,
            "latlng" => "${lat},${lng}"
                            ]
            ]
        );

        return $this->handleResponse($response);
    }

    /**
     * getCoordsFromAddress returns coordinates from an address
     * @param  string $address
     * @return Object         object of anonymous class containing lat/lng and formatted address
     */
    public function getCoordsFromAddress($address)
    {
        $response = $this->client->request(
            'get',
            $this->googleApiUrl,
            [
             "query" => [
            "key" => $this->googleApiToken,
            "address" => $address
                            ]
            ]
        );

        return $this->handleResponse($response);
    }
    /**
     * [handleResponse handle guzzle response
     * @param GuzzleHttp\Psr7\Response $rawResponse
     * @return Object      object of anonymous class containing lat/lng and formatted address
     */
    private function handleResponse($rawResponse)
    {
        if ($rawResponse->getStatusCode() != 200) {
            throw new \Exception("Error connecting To api");
        }
        $response = json_decode($rawResponse->getBody());
        
        if (!empty($response->error_message)) {
            throw new \Exception(json_decode($response->error_message));
        } elseif (!count($response->results)) {
            return new class {
                public $lat = 0;
                public $lng = 0;
                public $address = "";
            };
        }
        $lat = $response->results[0]->geometry->location->lat;
        $lng = $response->results[0]->geometry->location->lng;
        $address = $response->results[0]->formatted_address;

        return new class($lat, $lng, $address) {
            public function __construct($lat, $lng, $address)
            {
                $this->lat = $lat;
                $this->lng = $lng;
                $this->address = $address;
            }
        };
    }
}
