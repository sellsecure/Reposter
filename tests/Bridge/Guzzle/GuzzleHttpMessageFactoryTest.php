<?php

namespace Reposter\tests\Bridge\Guzzle;

use Reposter\Bridge\Guzzle\GuzzleHttpMessageFactory;
use Reposter\Http\Message\HttpMessageFactoryInterface;

/**
 * Class GuzzleHttpMessageFactoryTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class GuzzleHttpMessageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that the implementation is correctly made.
     */
    public function testBridge()
    {
        $guzzleHttpMessageFactory = new GuzzleHttpMessageFactory();

        $this->assertInstanceOf(HttpMessageFactoryInterface::class, $guzzleHttpMessageFactory);
    }

    /**
     * Tests that the created Request is correct.
     */
    public function testCreateRequest()
    {
        $guzzleHttpMessageFactory = new GuzzleHttpMessageFactory();

        $request = $guzzleHttpMessageFactory->createRequest('TEST', 'http://tester.testing.test', ['X-Test' => 'Test'], 'Test', 'TEST');

        $this->assertEquals($request->getMethod(), 'TEST');
        $this->assertEquals($request->getUri()->__toString(), 'http://tester.testing.test');
        $this->assertEquals($request->getHeaderLine('X-Test'), 'Test');
        $this->assertEquals($request->getBody()->getContents(), 'Test');
        $this->assertEquals($request->getProtocolVersion(), 'TEST');
    }

    /**
     * Tests that the created Response is correct.
     */
    public function testCreateResponse()
    {
        $guzzleHttpMessageFactory = new GuzzleHttpMessageFactory();

        $response = $guzzleHttpMessageFactory->createResponse(999, ['X-Test' => 'Test'], 'Test', 'TEST', 'Just Testing');

        $this->assertEquals($response->getStatusCode(), 999);
        $this->assertEquals($response->getHeaderLine('X-Test'), 'Test');
        $this->assertEquals($response->getBody()->getContents(), 'Test');
        $this->assertEquals($response->getProtocolVersion(), 'TEST');
        $this->assertEquals($response->getReasonPhrase(), 'Just Testing');
    }
}
