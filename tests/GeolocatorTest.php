<?php
namespace Naciri\Geolocator\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Naciri\Geolocator\Geolocator;

class GeolocatorTest extends TestCase
{
    private $geolocator;

    public function setUp()
    {
        $this->geolocator = new Geolocator(new Client());
    }

    public function testInstance()
    {
        $this->assertNotNull($this->geolocator);
    }
    public function testGetAddressFromCoords()
    {
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
        $result = $this->geolocator->getAddressFromCoords(12.3, 10.7);
        $this->assertIsObject($result);
        $this->assertObjectHasAttribute("address", $result);
        $this->assertObjectHasAttribute("lat", $result);
        $this->assertObjectHasAttribute("lng", $result);
        $this->assertNotNull($result->address);
        $this->assertSame(12.3, round($result->lat, 1));
        $this->assertSame(10.7, round($result->lng, 1));
    }
}
