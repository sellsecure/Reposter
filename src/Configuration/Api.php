<?php

namespace Reposter\Configuration;

use Psr\Log\LoggerInterface;

/**
 * Class Api.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class Api
{
    /**
     * Contains the logger.
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Contains the name.
     *
     * @var string
     */
    private $name;

    /**
     * Contains the base URL.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * Contains the resource mapping.
     *
     * @var ResourceMapping
     */
    private $resourceMapping;

    /**
     * Gets the logger.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
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
     * Gets the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the base URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Sets the base URL.
     *
     * @param string $baseUrl
     *
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Gets the resource mapping.
     *
     * @return ResourceMapping
     */
    public function getResourceMapping()
    {
        return $this->resourceMapping;
    }

    /**
     * Sets the resource mapping.
     *
     * @param ResourceMapping $resourceMapping
     *
     * @return $this
     */
    public function setResourceMapping(ResourceMapping $resourceMapping)
    {
        $this->resourceMapping = $resourceMapping;

        return $this;
    }
}
