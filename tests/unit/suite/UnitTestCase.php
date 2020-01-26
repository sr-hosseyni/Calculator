<?php

namespace Calculator\Tests;

use PHPUnit\Framework\TestCase;

/**
 * UnitTestCase, Base class for our TestCases
 *
 * @author sr_hosseini
 */
class UnitTestCase extends TestCase
{

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, string $methodName, array $parameters = array())
    {
        return $this->invokeStaticMethod(get_class($object), $methodName, $parameters);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param string $class      class name that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeStaticMethod(string $class, string $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass($class);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
    
    /**
     * Returns mock directory's path
     * @return string
     */
    public function getMockDirPath(): string
    {
        return dirname(__DIR__) . '/mock';
    }
}
