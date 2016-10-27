<?php

namespace Reposter;

use Reposter\Configuration\Configuration;

/**
 * Class Reposter.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class Reposter
{
    /**
     * Contains the configuration.
     *
     * @var Configuration
     */
    private $configuration;

    /**
     * Constructor.
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Gets the configuration.
     *
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
}
