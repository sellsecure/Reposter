<?php

namespace Reposter\tests\Exception;

use Reposter\Exception\Exception;

/**
 * Class ExceptionTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that Reposter Exception extends of the root \Exception class.
     */
    public function testExtendsException()
    {
        $exception = new Exception();

        $this->assertInstanceOf(\Exception::class, $exception);
    }
}
