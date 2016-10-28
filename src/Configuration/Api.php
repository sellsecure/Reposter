<?php

namespace Reposter\Configuration;

/**
 * Class Api.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class Api
{
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
}
