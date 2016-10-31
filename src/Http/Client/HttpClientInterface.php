<?php

namespace Reposter\Http\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClientInterface.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
interface HttpClientInterface
{
    /**
     * Sends a HTTP request.
     *
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return ResponseInterface
     */
    public function send(RequestInterface $request, array $options = []);
}
