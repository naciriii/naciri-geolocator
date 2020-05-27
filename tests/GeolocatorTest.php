<?php
namespace Naciri\Geolocator\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Naciri\Geolocator\Geolocator;

class GeolocatorTest extends TestCase
{
    private $geolocator;

    public function setUp():void
    {
        $clientStub = $this->createStub(Client::class);
        $this->geolocator = new Geolocator($clientStub);
    }

    public function testInstanceHasCorrectClient()
    {
        $this->assertInstanceOf(ClientInterface::class, $this->geolocator->client);
    }
    public function testGetAddressFromCoords()
    {
        $this->geolocator->client->method('request')->with("get", $this->istype('string'), $this->arrayHasDeepKey('latlng'))->willReturn($this->getAddressFromCoordsResponse());

        $result = $this->geolocator->getAddressFromCoords(12.3, 10.7);
        $this->assertIsObject($result);
        $this->assertObjectHasAttribute("address", $result);
        $this->assertObjectHasAttribute("lat", $result);
        $this->assertObjectHasAttribute("lng", $result);
        $this->assertNotNull($result->address);
        $this->assertSame(12.3, round($result->lat, 1));
        $this->assertSame(10.7, round($result->lng, 1));
    }
    public function testGetCoordsFromAddress()
    {
        $this->geolocator->client->method('request')->with("get", $this->istype('string'), $this->arrayHasDeepKey('address'))->willReturn($this->getCoordsFromAddressResponse());

        $result = $this->geolocator->getCoordsFromAddress("fakeAddress");
        $this->assertIsObject($result);
        $this->assertObjectHasAttribute("lat", $result);
        $this->assertObjectHasAttribute("lng", $result);
        $this->assertNotNull($result->address);
        $this->assertSame(12.3, round($result->lat, 1));
        $this->assertSame(10.7, round($result->lng, 1));
    }
    private function getAddressFromCoordsResponse()
    {
        return new class {
            public function getStatusCode()
            {
                return 200;
            }
            public function getBody()
            {
                return '{
                    "results" : [
                       {
                          "address_components" : [
                             {
                                "long_name" : "1600",
                                "short_name" : "1600",
                                "types" : [ "street_number" ]
                             },
                             {
                                "long_name" : "Amphitheatre Pkwy",
                                "short_name" : "Amphitheatre Pkwy",
                                "types" : [ "route" ]
                             },
                             {
                                "long_name" : "Mountain View",
                                "short_name" : "Mountain View",
                                "types" : [ "locality", "political" ]
                             },
                             {
                                "long_name" : "Santa Clara County",
                                "short_name" : "Santa Clara County",
                                "types" : [ "administrative_area_level_2", "political" ]
                             },
                             {
                                "long_name" : "California",
                                "short_name" : "CA",
                                "types" : [ "administrative_area_level_1", "political" ]
                             },
                             {
                                "long_name" : "United States",
                                "short_name" : "US",
                                "types" : [ "country", "political" ]
                             },
                             {
                                "long_name" : "94043",
                                "short_name" : "94043",
                                "types" : [ "postal_code" ]
                             }
                          ],
                          "formatted_address" : "fakeAddress",
                          "geometry" : {
                             "location" : {
                                "lat" : 12.3,
                                "lng" : 10.7
                             },
                             "location_type" : "ROOFTOP",
                             "viewport" : {
                                "northeast" : {
                                   "lat" : 37.4238253802915,
                                   "lng" : -122.0829009197085
                                },
                                "southwest" : {
                                   "lat" : 37.4211274197085,
                                   "lng" : -122.0855988802915
                                }
                             }
                          },
                          "place_id" : "ChIJ2eUgeAK6j4ARbn5u_wAGqWA",
                          "plus_code": {
                             "compound_code": "CWC8+W5 Mountain View, California, United States",
                             "global_code": "849VCWC8+W5"
                          },
                          "types" : [ "street_address" ]
                       }
                    ],
                    "status" : "OK"
                 }';
            }
        };
    }
    private function getCoordsFromAddressResponse()
    {
        return new class {
            public function getStatusCode()
            {
                return 200;
            }
            public function getBody()
            {
                return '{
                    "results" : [
                       {
                          "address_components" : [
                             {
                                "long_name" : "1600",
                                "short_name" : "1600",
                                "types" : [ "street_number" ]
                             },
                             {
                                "long_name" : "Amphitheatre Pkwy",
                                "short_name" : "Amphitheatre Pkwy",
                                "types" : [ "route" ]
                             },
                             {
                                "long_name" : "Mountain View",
                                "short_name" : "Mountain View",
                                "types" : [ "locality", "political" ]
                             },
                             {
                                "long_name" : "Santa Clara County",
                                "short_name" : "Santa Clara County",
                                "types" : [ "administrative_area_level_2", "political" ]
                             },
                             {
                                "long_name" : "California",
                                "short_name" : "CA",
                                "types" : [ "administrative_area_level_1", "political" ]
                             },
                             {
                                "long_name" : "United States",
                                "short_name" : "US",
                                "types" : [ "country", "political" ]
                             },
                             {
                                "long_name" : "94043",
                                "short_name" : "94043",
                                "types" : [ "postal_code" ]
                             }
                          ],
                          "formatted_address" : "fakeAddress",
                          "geometry" : {
                             "location" : {
                                "lat" : 12.3,
                                "lng" : 10.7
                             },
                             "location_type" : "ROOFTOP",
                             "viewport" : {
                                "northeast" : {
                                   "lat" : 37.4238253802915,
                                   "lng" : -122.0829009197085
                                },
                                "southwest" : {
                                   "lat" : 37.4211274197085,
                                   "lng" : -122.0855988802915
                                }
                             }
                          },
                          "place_id" : "ChIJ2eUgeAK6j4ARbn5u_wAGqWA",
                          "plus_code": {
                             "compound_code": "CWC8+W5 Mountain View, California, United States",
                             "global_code": "849VCWC8+W5"
                          },
                          "types" : [ "street_address" ]
                       }
                    ],
                    "status" : "OK"
                 }';
            }
        };
    }
}
