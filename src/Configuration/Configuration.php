<?php

namespace Reposter\Configuration;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Reposter\Exception\InvalidArgumentException;
use Reposter\Http\Client\HttpClientInterface;
use Reposter\Http\Message\HttpMessageFactoryInterface;

/**
 * Class Configuration.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class Configuration
{
    /**
     * Contains the logger.
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Contains the HTTP client.
     *
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * Contains the HTTP message factory.
     *
     * @var HttpMessageFactoryInterface
     */
    private $httpMessageFactory;

    /**
     * Contains the APis.
     *
     * @var Api[]
     */
    private $apis = [];

    /**
     * Gets the logger.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger ?: new NullLogger();
    }

    /**
     * Sets the logger.
     *
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Gets the httpClient.
     *
     * @return HttpClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Sets the httpClient.
     *
     * @param HttpClientInterface $httpClient
     *
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Gets the HTTP message factory.
     *
     * @return HttpMessageFactoryInterface
     */
    public function getHttpMessageFactory()
    {
        return $this->httpMessageFactory;
    }

    /**
     * Sets the HTTP message factory.
     *
     * @param HttpMessageFactoryInterface $httpMessageFactory
     *
     * @return $this
     */
    public function setHttpMessageFactory(HttpMessageFactoryInterface $httpMessageFactory)
    {
        $this->httpMessageFactory = $httpMessageFactory;

        return $this;
    }

    /**
     * Adds an API.
     *
     * @param Api $api
     *
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function addApi(Api $api)
    {
        // Checks whether the given API is added
        if (array_key_exists($api->getName(), $this->apis)) {
            throw new InvalidArgumentException(sprintf(
                'The API with the name « %s » is already added',
                $api->getName()
            ));
        }

        $this->apis[$api->getName()] = $api;

        // Adds the default logger into the added API
        if ($api->getLogger() === null) {
            $api->setLogger($this->getLogger());
        }

        return $this;
    }

    /**
     * Removes an API.
     *
     * @param Api $api
     *
     * @return $this
     */
    public function removeApi(Api $api)
    {
        if (array_key_exists($api->getName(), $this->apis)) {
            unset($this->apis[$api->getName()]);
        }

        return $this;
    }

    /**
     * Gets an API with a specified name.
     *
     * @param string $name
     *
     * @return null|Api
     */
    public function getApi($name)
    {
        return array_key_exists($name, $this->apis) ? $this->apis[$name] : null;
    }

    /**
     * Gets the APIs.
     *
     * @return Api[]
     */
    public function getApis()
    {
        return $this->apis;
    }
}
