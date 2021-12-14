<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use Looper\models\Exercise;
use PHPUnit\Framework\TestCase;

class ExerciseTest extends TestCase
{
    /**
     * @covers Exercise::all()
     */
    public function testAll()
    {
        $this->assertEquals(6, count(Exercise::all()));
    }

    /**
     * @covers Exercise::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Exercise::class, Exercise::find(1));
    }

    /**
     * @covers Exercise::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Exercise::find(1000));
    }

    /**
     * @covers Exercise::allWhere()
     */
    public function testWhere_ifResultExist()
    {
        $this->assertEquals(2, count(Exercise::allWhere('status_id', 1)));
    }

    /**
     * @covers Exercise::allWhere()
     */
    public function testWhere_ifResultNotExist()
    {
        $this->assertEquals(0, count(Exercise::allWhere('status_id', 200)));
    }

    /**
     * @covers  Exercise::create()
     * @depends testFind_ifValueExist
     */
    public function testCreate()
    {
        $exercise = Exercise::make(["title" => 'UnitTest Exercise', "status_id" => 1]);

        $this->assertEquals('UnitTest Exercise', $exercise->title);
        $this->assertEquals(1, $exercise->status_id);
        $this->assertTrue($exercise->create());
        $this->assertNotNull(Exercise::find($exercise->id));
    }

    /**
     * @covers  Exercise::update()
     * @depends testFind_ifValueExist
     */
    public function testUpdate()
    {
        $exercise = Exercise::find(7);
        $exercise->title = 'UnitTest Title';
        $this->assertTrue($exercise->update());
        $this->assertEquals("UnitTest Title", Exercise::find($exercise->id)->title);
    }

    /**
     * @covers  Exercise::delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $exercise = Exercise::find(7);
        $id = $exercise->id;
        $this->assertTrue($exercise->delete());
        $this->assertNull(Exercise::find($id));
    }
}
