<?php

require_once (__DIR__ . '/Game.php');
require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/EndFrame.php');

// $frame = new EndFrame();
//
// $frame->roll(3);
// $frame->roll(7);
// $frame->roll(10);

$game = new Game();

$game->roll(1);
$game->roll(3);

$game->roll(10);

$game->roll(9);
$game->roll(0);

$game->roll(10);

$game->roll(10);

$game->roll(10);

$game->roll(10);

$game->roll(10);

$game->roll(10);

$game->roll(9);
$game->roll(1);
$game->roll(1);

var_dump ($game->isFinished());
echo PHP_EOL;
