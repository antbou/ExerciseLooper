<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use Looper\models\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    /**
     * @covers Status::all()
     */
    public function testAll()
    {
        $this->assertEquals(3, count(Status::all()));
    }

    /**
     * @covers Status::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Status::class, Status::find(1));
    }

    /**
     * @covers Status::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Status::find(1000));
    }

    /**
     * @covers  status->update()
     * @depends testFind_ifValueExist
     */
    public function testUpdate()
    {
        $status = Status::find(3);
        $status->value = 'testName';
        $status->slug = 'testSlug';
        $this->assertTrue($status->update());
        $status = Status::find(3);
        $this->assertEquals('testName', $status->value);
        $this->assertEquals('testSlug', $status->slug);
    }

    /**
     * @covers  Status::findBySlug()
     * @depends testFind_ifValueExist
     */
    public function testFindBySlug_ifSlugExists()
    {
        $status = Status::findBySlug('testSlug');
        $this->assertInstanceOf(Status::class, $status);
        $this->assertEquals('testSlug', $status->slug);
    }

    /**
     * @covers  Status::findBySlug()
     * @depends testFind_ifValueExist
     */
    public function testFindBySlug_ifSlugDoesNotExist()
    {
        $status = Status::findBySlug('slug');
        $this->assertNull($status);
    }

    /**
     * @covers  status->delete()
     * @depends testFind_ifValueExist
     */
    public function testDelete()
    {
        $status = Status::find(3);
        $id = $status->id;
        $this->assertFalse($status->delete()); // expected to fail due to a foreign key constraint
        $this->assertNotNull(Status::find($id));
    }

    /**
     * @covers  status->update()
     * @depends testFind_ifValueExist, testUpdate
     */
    public function testResetSlug()
    {
        $status = Status::find(3);
        $status->value = 'terminate';
        $status->slug = 'TERM';
        $this->assertTrue($status->update());
    }
}
