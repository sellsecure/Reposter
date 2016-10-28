<?php

namespace Reposter\Configuration;

/**
 * Class ResourceMapping.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ResourceMapping
{
    /**
     * Contains the type.
     *
     * @var string
     */
    private $type;

    /**
     * Contains the attributes.
     *
     * @var array
     */
    private $attributes = [];

    /**
     * Gets the type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Gets an attribute with a specified key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        return $this->hasAttribute($key) ? $this->attributes[$key] : null;
    }

    /**
     * Checks whether an attribute exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }

    /**
     * Adds an attribute.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Removes an attribute with a specified key.
     *
     * @param string $key
     *
     * @return $this
     */
    public function removeAttribute($key)
    {
        if ($this->hasAttribute($key)) {
            unset($this->attributes[$key]);
        }

        return $this;
    }

    /**
     * Sets the attributes.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
