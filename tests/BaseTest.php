<?php

class BaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Call a private/protected method of the given object.
     *
     * @param $object object
     * @param $method string
     * @param $params array
     * @return mixed
     */
    protected function invokeMethod($object, $method, array $params = [])
    {
        $reflection        = new \ReflectionClass(get_class($object));
        $reflection_method = $reflection->getMethod($method);

        $reflection_method->setAccessible(true);

        return $reflection_method->invokeArgs($object, $params);
    }
}
