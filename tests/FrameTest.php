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

    public function testCanGetStrikesCount()
    {
        $frame = new Frame();

        // make sure strikes count is 0 when there are no rolls
        $this->assertEquals($frame->getStrikesCount(), 0);

        // make a non-strike roll
        $frame->roll(5);

        // make sure strikes count is 0 since the roll wasn't a strike
        $this->assertEquals($frame->getStrikesCount(), 0);

        // reset frame
        $frame = new Frame();

        // make a strike roll
        $frame->roll(10);

        // make sure strikes count is 1 since the roll was a strike
        $this->assertEquals($frame->getStrikesCount(), 1);
    }

    public function testCanGetSparesCount()
    {
        $frame = new Frame();

        // make sure spares count is 0 when there are no rolls
        $this->assertEquals($frame->getSparesCount(), 0);

        // make first roll
        $frame->roll(5);

        // make sure spares count is still 0
        $this->assertEquals($frame->getSparesCount(), 0);

        // make second spare-causing roll
        $frame->roll(5);

        // make sure spares count is 1 since the rolls added up to 10
        $this->assertEquals($frame->getSparesCount(), 1);

        // reset frame
        $frame = new Frame();

        // make two rolls that don't make a spare
        $frame->roll(1);
        $frame->roll(1);

        // make sure spares count is 0 since the rolls didn't add up to 10
        $this->assertEquals($frame->getSparesCount(), 0);
    }

    public function testIfIsStrike()
    {
        $frame = new Frame();

        // make non-strike rolls
        $frame->roll(1);
        $frame->roll(1);

        // make sure it is not a strike
        $this->assertEquals($frame->isStrike(), false);

        // reset frame
        $frame = new Frame();

        // make strike roll
        $frame->roll(10);

        // make sure it is a strike
        $this->assertEquals($frame->isStrike(), true);
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
