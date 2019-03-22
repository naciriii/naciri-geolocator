<?php
namespace Naciri\Geolocator\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;


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
