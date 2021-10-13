<?php

use PHPUnit\Framework\TestCase;
use Looper\core\services\Router;

class RouterTest extends TestCase
{
    /**
     * @covers $router->getUrl()
     */
    public function testGetUrl()
    {

        $router = new Router();
        $router->add('test1/:id', 'testName1', 'testController1', 'testMethod1');
        $router->add('test2/:id', 'testName2', 'testController2', 'testMethod2');

        $urlToTest = 'test1/18';


        $this->assertSame($urlToTest, $router->getUrl('testName1', ['id' => 18]));
        $this->assertNotSame($urlToTest, $router->getUrl('testName1', ['id' => 20]));
    }
}
