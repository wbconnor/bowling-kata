<?php

class Game
{

    protected $score;

    /**
     * Constructor initializes all properties.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->score = 0;
    }

    /**
     * The ball rolls and knocks over the given number of pins.
     *
     * @param $pins int
     * @return void
     */
    public function roll($pins)
    {
        $this->score += $pins;
    }

    /**
     * Return the total score for the game.
     *
     * @return int
     */
    public function score()
    {
        return $this->score;
    }
}
