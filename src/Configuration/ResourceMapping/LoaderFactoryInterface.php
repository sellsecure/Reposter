<?php

namespace Reposter\Configuration\ResourceMapping;

/**
 * Interface LoaderFactoryInterface.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
interface LoaderFactoryInterface
{
    /**
     * Creates a new instance of LoaderInterface with a specified type.
     *
     * @param string $type
     */
    public function create($type);
}
