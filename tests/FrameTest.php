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
}
