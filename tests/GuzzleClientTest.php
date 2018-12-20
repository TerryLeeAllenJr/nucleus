<?php

use PHPUnit\Framework\TestCase;
use Union\Nucleus\Request\RequestInterface;
use Union\Nucleus\Response\ResponseInterface;

/**
 *  Corresponding Class to test YourClass class
 *
 *  For each class in your library, there should be a corresponding Unit-Test for it
 *  Unit-Tests should be as much as possible independent from other test going on.
 *
 *  @author Lee Allen
 */

class GuzzleClientTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $this->setEnv();

        $request  = $this->createRequestStub();
        $response = $this->createResponseStub();

        $var = new Union\Nucleus\Client\GuzzleClient($request, $response);
        $this->assertTrue(is_object($var));

        unset($var);
        unset($request);
        unset($response);

        $this->clearEnv();
    }


    private function createRequestStub()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createMock(RequestInterface::class);

        // Configure the stub.
        $stub->method('getAuth')
            ->willReturn(['foo','bar']);

        $stub->method('getBody')
            ->willReturn('{"foo": "bar"}');

        $stub->method('getRequestMethod')
            ->willReturn("GET");

        $stub->method('getUrl')
            ->willReturn("https://www.google.com");

        return $stub;
    }

    private function createResponseStub()
    {
        $stub = $this->createMock(ResponseInterface::class);

        return $stub;
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Sets the required environment varialbes.
     */
    protected function setEnv()
    {
        putenv('RAISERVICE_BASE_URL=FOO');
        putenv('RAISERVICE_AUTH_USER=FOO');
        putenv('RAISERVICE_AUTH_PASSWORD=FOO');
    }

    /**
     * Clears the required environment variables.
     */
    protected function clearEnv()
    {
        putenv('RAISERVICE_BASE_URL');
        putenv('RAISERVICE_AUTH_USER');
        putenv('RAISERVICE_AUTH_PASSWORD');
    }
}
