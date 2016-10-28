<?php

namespace Reposter\Configuration;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Reposter\Exception\InvalidArgumentException;

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
