<?php

require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/EndFrame.php');

$frame = new EndFrame();

$frame->roll(3);
$frame->roll(7);
$frame->roll(10);

var_dump ($frame->isFinished());
echo PHP_EOL;


// $game = new Game();

// $game->run();
