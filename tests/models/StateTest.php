<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use Looper\models\State;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    /**
     * @covers State::all()
     */
    public function testAll()
    {
        $this->assertEquals(3, count(State::all()));
    }

    /**
     * @covers State::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(State::class, State::find(1));
    }

    /**
     * @covers State::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(State::find(1000));
    }

    /**
     * @covers  state->update()
     * @depends testFind_ifValueExist
     */
    public function testUpdate()
    {
        $state = State::find(3);
        $state->name = 'testName';
        $state->slug = 'testSlug';
        $this->assertTrue($state->update());
        $state = State::find(3);
        $this->assertEquals('testName', $state->name);
        $this->assertEquals('testSlug', $state->slug);
    }

    /**
     * @covers  State::findBySlug()
     * @depends testFind_ifValueExist
     */
    public function testFindBySlug_ifSlugExists()
    {
        $state = State::findBySlug('testSlug');
        $this->assertInstanceOf(State::class, $state);
        $this->assertEquals('testSlug', $state->slug);
    }

    /**
     * @covers  State::findBySlug()
     * @depends testFind_ifValueExist
     */
    public function testFindBySlug_ifSlugDoesNotExist()
    {
        $state = State::findBySlug('slug');
        $this->assertNull($state);
    }

    /**
     * @covers  state->delete()
     * @depends testFind_ifValueExist
     */
    public function testDelete()
    {
        $state = State::find(3);
        $id = $state->id;
        $this->assertFalse($state->delete()); // expected to fail due to a foreign key constraint
        $this->assertNotNull(State::find($id));
    }
}
