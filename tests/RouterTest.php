<?php

require('core/service/Router.php');

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @covers $router->getUrl()
     */
    public function testGetUrl()
    {

        $router = new Router();
        $router->add('/test1/:id', 'testName1', 'testController1', 'testMethod1');
        $router->add('/test2/:id', 'testName2', 'testController2', 'testMethod2');


        $this->assertSame('test1/18', $router->getUrl('testName1', ['id' => 18]));
        $this->assertNotSame('test1/18', $router->getUrl('testName1', ['id' => 20]));
    }
}
