<?php

namespace Reposter\Http\Message;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface HttpMessageFactoryInterface.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
interface HttpMessageFactoryInterface
{
    /**
     * Creates a RequestInterface instance.
     *
     * @param string                               $method
     * @param string|UriInterface                  $uri
     * @param array                                $headers
     * @param string|null|resource|StreamInterface $body
     * @param string                               $version
     *
     * @return RequestInterface
     */
    public function createRequest($method, $uri, array $headers = [], $body = null, $version = '1.1');

    /**
     * Creates a ResponseInterface response.
     *
     * @param int                                  $status
     * @param array                                $headers
     * @param string|null|resource|StreamInterface $body
     * @param string                               $version
     * @param string|null                          $reason
     *
     * @return ResponseInterface
     */
    public function createResponse($status = 200, array $headers = [], $body = null, $version = '1.1', $reason = null);
}
