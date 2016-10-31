<?php

namespace Reposter\Bridge\Guzzle;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Reposter\Http\Message\HttpMessageFactoryInterface;

/**
 * Class GuzzleHttpMessageFactory.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class GuzzleHttpMessageFactory implements HttpMessageFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createRequest($method, $uri, array $headers = [], $body = null, $version = '1.1')
    {
        return new Request($method, $uri, $headers, $body, $version);
    }

    /**
     * {@inheritdoc}
     */
    public function createResponse($status = 200, array $headers = [], $body = null, $version = '1.1', $reason = null)
    {
        return new Response($status, $headers, $body, $version, $reason);
    }
}
