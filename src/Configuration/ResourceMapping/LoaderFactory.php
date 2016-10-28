<?php

namespace Reposter\Configuration\ResourceMapping;

use Reposter\Exception\InvalidArgumentException;

/**
 * Class LoaderFactory.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class LoaderFactory implements LoaderFactoryInterface
{
    /**
     * Contains the loaders.
     *
     * @var LoaderInterface[]
     */
    private $loaders = [];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->loaders = [
            new FileLoader(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function create($type)
    {
        if (array_key_exists($type, $this->loaders)) {
            return clone $this->loaders[$type];
        }

        throw new InvalidArgumentException(sprintf(
            'There is no loader registered with the name « %s » in the factory',
            $type
        ));
    }

    /**
     * Adds a loader.
     *
     * @param LoaderInterface $loader
     *
     * @return $this
     */
    public function addLoader(LoaderInterface $loader)
    {
        $this->loaders[$loader->getType()] = $loader;

        return $this;
    }

    /**
     * Removes a loader.
     *
     * @param LoaderInterface $loader
     *
     * @return $this
     */
    public function removeLoader(LoaderInterface $loader)
    {
        if (array_key_exists($loader->getType(), $this->loaders)) {
            unset($this->loaders[$loader->getType()]);
        }

        return $this;
    }

    /**
     * Gets the loaders.
     *
     * @return LoaderInterface[]
     */
    public function getLoaders()
    {
        return $this->loaders;
    }
}
