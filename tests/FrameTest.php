<?php

require_once (__DIR__ . '/BaseTest.php');
require_once (__DIR__ . '/../Frame.php');

class FrameTest extends BaseTest
{
    public function testCanBeConstructed()
    {
        $frame = new Frame();

        $this->assertInstanceOf(Frame::class, $frame);
    }

    public function testCanRoll()
    {
        $frame = new Frame();

        $this->assertEquals($frame->getRollsCount(), 0);

        $frame->roll(5);

        $this->assertEquals($frame->getRollsCount(), 1);
    }

    public function testCanGetRoll()
    {
        $frame = new Frame();

        $frame->roll(5);

        $this->assertEquals($frame->getRoll(0), 5);
    }

    public function testCanGetRolls()
    {
        $frame = new Frame();
        $rolls = [ 1, 2 ];

        foreach ($rolls as $roll)
        {
            $frame->roll($roll);
        }

        $this->assertEquals($frame->getRolls(), $rolls);
    }

    public function testCanGetRollsCount()
    {
        $frame = new Frame();

        $frame->roll(5);

        $this->assertEquals($frame->getRollsCount(), 1);
    }

    public function testCanGetScore()
    {
        $frame = new Frame();

        // make sure score is 0 when there are no rolls
        $this->assertEquals($frame->getScore(), 0);

        // make the first roll
        $frame->roll(3);

        // make sure score matches first roll
        $this->assertEquals($frame->getScore(), 3);

        // make the second roll
        $frame->roll(2);

        // make sure score matches first roll plus second roll
        $this->assertEquals($frame->getScore(), 5);
    }

    public function testCanScore()
    {
        $frame = new Frame();

        $this->assertEquals($frame->getRollsCount(), 0);
        $this->assertEquals($frame->getScore(), 0);

        $this->invokeMethod($frame, 'score', [ 5 ]);

        $this->assertEquals($frame->getRollsCount(), 1);
        $this->assertEquals($frame->getScore(), 5);
    }
}
