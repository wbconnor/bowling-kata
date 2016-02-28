<?php

require_once (__DIR__ . '/Game.php');
require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/EndFrame.php');

$game = new Game();
$game->run();