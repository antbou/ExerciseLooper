<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use Looper\models\Question;
use Looper\models\Response;
use Looper\models\Serie;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @covers Response::all()
     */
    public function testAll()
    {
        $this->assertEquals(2, count(Response::all()));
    }

    /**
     * @covers Response::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Response::class, Response::find(1));
    }

    /**
     * @covers Response::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Response::find(1000));
    }

    /**
     * @covers Response::allWhere()
     */
    public function testWhere_ifResultExist()
    {
        $this->assertEquals(2, count(Response::allWhere('question_id', 6)));
    }

    /**
     * @covers Response::allWhere()
     */
    public function testWhere_ifResultNotExist()
    {
        $this->assertEquals(0, count(Response::allWhere('question_id', 200)));
    }

    /**
     * @covers  Response::make()
     * @depends testFind_ifValueExist
     */
    public function testCreate()
    {
        $response = Response::make(["value" => 'test', "question_id" => 1, "serie_id" => 1]);
        $this->assertEquals("test", $response->value);
        $this->assertEquals(1, $response->question_id);
        $this->assertEquals(1, $response->serie_id);
        $this->assertTrue($response->create());
        $this->assertNotNull(Response::find($response->id));
    }

    /**
     * @covers  response->update()
     * @depends testFind_ifValueExist
     */
    public function testUpdate()
    {
        $response = Response::find(3);
        $response->value = 'testUnit';
        $this->assertTrue($response->update());
        $response = Response::find(3);
        $this->assertEquals("testUnit", Response::find($response->id)->value);
    }

    /**
     * @covers  response->getQuestion()
     * @depends testFind_ifValueExist
     */
    public function testQuestion()
    {
        $response = Response::find(1);
        $this->assertInstanceOf(Question::class, $response->getQuestion());
    }

    /**
     * @covers  response->getSerie()
     * @depends testFind_ifValueExist
     */
    public function testSerie()
    {
        $response = Response::find(1);
        $this->assertInstanceOf(Serie::class, $response->getSerie());
    }


    /**
     * @covers  response->delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $response = Response::find(3);
        $id = $response->id;
        $this->assertTrue($response->delete());
        $this->assertNull(Response::find($id));
    }
}
