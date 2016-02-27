<?php

require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/EndFrame.php');

class Game
{
    protected $score;
    protected $frames;
    protected $max_frames;
    protected $is_finished;

    /**
     * Constructor initializes all properties.
     *
     * @return void
     */
    public function __construct()
    {
        $this->score       = 0;
        $this->frames      = [];
        $this->max_frames  = 10;
        $this->is_finished = false;

        $this->frames[] = new Frame();
    }

    /**
     * The ball rolls and knocks over the given number of pins.
     *
     * @param $pins int
     * @return void
     */
    public function roll($pins = 0)
    {
        if (count($this->frames) <= $this->max_frames && !$this->is_finished)
        {
            if (! &$this->getCurrentFrame()->isFinished())
            {
                &$this->getCurrentFrame()->roll($pins);
            }
            else
            {
                if (count($this->frames) < $this->max_frames - 1)
                {
                    $this->frames[] = new Frame();
                }
                else if (count($this->frames) < $this->max_frames)
                {
                    $this->frames[] = new EndFrame();
                }
                else
                {
                    $this->is_finished = true;
                }
            }
        }
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

    protected function &getCurrentFrame()
    {
        return $this->frames[count($this->frames) - 1];
    }
}
