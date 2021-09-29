<?php

require('core/service/Route.php');

use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    /**
     * @covers $route->doesMatch()
     */
    public function testDoesMatch()
    {
        $path = '/test/:id';
        $controllerName = 'test';
        $method = 'test';
        $route = new Route($path, $controllerName, $method);

        $urlTrue = '/test/18';
        $urlFalse = '/test/18/test';


        $this->assertTrue($route->doesMatch($urlTrue));
        $this->assertFalse($route->doesMatch($urlFalse));
    }

    /**
     * @covers $route->generateUrl()
     */
    public function testGenerateUrl()
    {
        $path = '/test/:id';
        $controllerName = 'test';
        $method = 'test';

        $param = ['id' => 18];

        $route = new Route($path, $controllerName, $method);
        $urlTrue = 'test/18';
        $urlFalse = 'test/false';

        $this->assertSame($urlTrue, $route->generateUrl($param));
        $this->assertNotSame($urlFalse, $route->generateUrl($param));
    }
}
