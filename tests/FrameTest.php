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
