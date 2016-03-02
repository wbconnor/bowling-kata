<?php

require_once (__DIR__ . '/Game.php');
require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/FinalFrame.php');

// create a new game and run it
$game = new Game();
$game->run();
