<?php

require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/EndFrame.php');

class Game
{
    protected $score;
    protected $frames;
    protected $max_frames;

    /**
     * Constructor initializes all properties.
     *
     * @return void
     */
    public function __construct()
    {
        $this->score      = 0;
        $this->frames     = [];
        $this->max_frames = 10;
    }

    /**
     * The ball rolls and knocks over the given number of pins.
     *
     * @param $pins int
     * @return void
     */
    public function roll($pins = 0)
    {
        
    }

    /**
     * Returns the total score for the game.
     *
     * @return int
     */
    public function score()
    {
        return $this->score;
    }

    /**
     * Runs the game.
     *
     * @return void
     */
    public function run()
    {

    }
}
