<?php

require_once (__DIR__ . '/../Frame.php');

class FrameTest extends \PHPUnit_Framework_TestCase
{
    public function testCanBeConstructed()
    {
        $frame = new Frame();

        $this->assertInstanceOf(Frame::class, $frame);
    }
}
