<?php

namespace Reposter\tests\Exception;

use Reposter\Exception\Exception;
use Reposter\Exception\InvalidArgumentException;

/**
 * Class InvalidArgumentExceptionTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class InvalidArgumentExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that Reposter InvalidArgumentException extends of the Reposter Exception class.
     */
    public function testExtendsException()
    {
        $exception = new InvalidArgumentException();

        $this->assertInstanceOf(Exception::class, $exception);
    }
}
