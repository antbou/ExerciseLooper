<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use Looper\models\Response;
use Looper\models\Serie;
use PHPUnit\Framework\TestCase;

class SerieTest extends TestCase
{
    /**
     * @covers Serie::all()
     */
    public function testAll()
    {
        $this->assertEquals(4, count(Serie::all()));
    }

    /**
     * @covers Serie::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Serie::class, Serie::find(1));
    }

    /**
     * @covers Serie::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Serie::find(1000));
    }

    /**
     * @covers Serie::allWhere()
     */
    public function testWhere_ifResultExist()
    {
        $this->assertEquals(3, count(Serie::allWhere('exercise_id', 2)));
    }

    /**
     * @covers Serie::allWhere()
     */
    public function testWhere_ifResultNotExist()
    {
        $this->assertEquals(0, count(Serie::allWhere('exercise_id', 200)));
    }

    /**
     * @covers  Serie::make()
     * @depends testFind_ifValueExist
     */
    public function testCreate()
    {
        $date = (new \DateTime('NOW', new \DateTimeZone("UTC")))->format('Y-m-d H:i:s');
        $serie = Serie::make([
            "date" => $date,
            "exercise_id" => 1,
        ]);
        $this->assertEquals($date, $serie->date);
        $this->assertEquals(1, $serie->exercise_id);
        $this->assertTrue($serie->create());
        $this->assertNotNull(Serie::find($serie->id));
    }

    /**
     * @covers  serie->update()
     * @depends testFind_ifValueExist
     */
    public function testUpdate()
    {
        $date = (new \DateTime('NOW', new \DateTimeZone("UTC")))->format('Y-m-d H:i:s');
        $serie = Serie::find(3);
        $serie->date = $date;
        $this->assertTrue($serie->update());
        $serie = Serie::find(3);
        $this->assertEquals($date, Serie::find($serie->id)->date);
    }

    /**
     * @covers  serie->getResponses()
     * @depends testFind_ifValueExist
     */
    public function testGetResponses_ifSerieHasResponses()
    {
        $serie = Serie::find(3);
        $response = $serie->getResponses()[0];
        $this->assertEquals(1, count($serie->getResponses()));
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($serie->id, $response->serie_id);
    }

    /**
     * @covers  serie->getResponses()
     * @depends testFind_ifValueExist
     */
    public function testGetResponses_ifSerieDoesNotHaveResponses()
    {
        $serie = Serie::find(5);
        $this->assertEmpty($serie->getResponses());
    }

    /**
     * @covers  serie->delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $serie = Serie::find(5);
        $id = $serie->id;
        $this->assertTrue($serie->delete());
        $this->assertNull(Serie::find($id));
    }
}
