<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use Looper\models\Question;
use Looper\models\Response;
use Looper\models\State;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    /**
     * @covers Question::all()
     */
    public function testAll()
    {
        $this->assertEquals(10, count(Question::all()));
    }

    /**
     * @covers Question::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Question::class, Question::find(1));
    }

    /**
     * @covers Question::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Question::find(1000));
    }

    /**
     * @covers Question::allWhere()
     */
    public function testWhere_ifResultExist()
    {
        $this->assertEquals(1, count(Question::allWhere('state_id', 3)));
    }

    /**
     * @covers Question::allWhere()
     */
    public function testWhere_ifResultNotExist()
    {
        $this->assertEquals(0, count(Question::allWhere('state_id', 200)));
    }

    /**
     * @covers  Question::make()
     * @depends testFind_ifValueExist
     */
    public function testCreate()
    {
        $question = Question::make(["value" => 'test', "exercise_id" => 1, "state_id" => 1]);

        $this->assertEquals("test", $question->value);
        $this->assertEquals(1, $question->exercise_id);
        $this->assertEquals(1, $question->state_id);
        $this->assertTrue($question->create());
        $this->assertNotNull(Question::find($question->id));
    }

    /**
     * @covers  Question->update()
     * @depends testFind_ifValueExist
     */
    public function testUpdate()
    {
        $question = Question::find(11);
        $question->value = 'test';
        $this->assertTrue($question->update());
        $question = Question::find(11);
        $this->assertEquals("test", Question::find($question->id)->value);
    }

    /**
     * @covers  Exercise->getState()
     * @depends testFind_ifValueExist
     */
    public function testGetState()
    {
        $question = Question::find(1);
        $this->assertInstanceOf(State::class, $question->getState());
    }

    /**
     * @covers  Exercise->getResponses()
     * @depends testFind_ifValueExist
     */
    public function testGetResponses_ifQuestionHasResponses()
    {
        $question = Question::find(6);
        $response = $question->getResponses()[0];
        $this->assertEquals(2, count($question->getResponses()));
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($question->id, $response->question_id);
    }

    /**
     * @covers  Exercise->getResponses()
     * @depends testFind_ifValueExist
     */
    public function testGetResponses_ifQuestionDoesNotHaveResponses()
    {
        $question = Question::find(3);
        $this->assertEmpty($question->getResponses());
    }


    /**
     * @covers  Question->delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {

        $question = Question::find(11);
        $id = $question->id;
        $this->assertTrue($question->delete());
        $this->assertNull(Question::find($id));
    }
}
