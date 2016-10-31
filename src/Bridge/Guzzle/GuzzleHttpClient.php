<?php

namespace Reposter\Bridge\Guzzle;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Reposter\Http\Client\HttpClientInterface;

/**
 * Class GuzzleHttpClient.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class GuzzleHttpClient extends Client implements HttpClientInterface
{
    /**
     * {@inheritdoc}
     */
    public function send(RequestInterface $request, array $options = [])
    {
        return parent::send($request, $options);
    }
}
