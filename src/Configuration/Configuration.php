<?php

namespace Reposter\Configuration;

use Reposter\Exception\InvalidArgumentException;

/**
 * Class Configuration.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class Configuration
{
    /**
     * Contains the APis.
     *
     * @var Api[]
     */
    private $apis = [];

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
