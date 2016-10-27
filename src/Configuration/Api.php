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
     * Constructor.
     *
     * @param string $name
     * @param string $baseUrl
     */
    public function __construct($name, $baseUrl)
    {
        $this->name = $name;
        $this->baseUrl = $baseUrl;
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
     * Gets the base URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
