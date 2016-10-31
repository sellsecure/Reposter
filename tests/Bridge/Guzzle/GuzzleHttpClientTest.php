<?php

namespace Reposter\tests\Bridge\Guzzle;

use GuzzleHttp\ClientInterface;
use Reposter\Bridge\Guzzle\GuzzleHttpClient;
use Reposter\Http\Client\HttpClientInterface;

/**
 * Class GuzzleHttpClientTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class GuzzleHttpClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that the implementation is correctly made.
     */
    public function testBridge()
    {
        $guzzleHttpClient = new GuzzleHttpClient();

        $this->assertInstanceOf(ClientInterface::class, $guzzleHttpClient);
        $this->assertInstanceOf(HttpClientInterface::class, $guzzleHttpClient);
    }
}
