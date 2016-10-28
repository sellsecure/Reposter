<?php

namespace Reposter\Configuration\ResourceMapping;

/**
 * Class FileLoader.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class FileLoader implements LoaderInterface
{
    /**
     * Contains the file.
     *
     * @var string
     */
    private $file;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'file';
    }

    /**
     * Gets the file.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets the file.
     *
     * @param string $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
