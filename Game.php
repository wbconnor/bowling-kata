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
            $this->getCurrentFrame()->roll($pins);

            if ($this->getCurrentFrame()->isFinished())
            {
                if (count($this->frames) < $this->max_frames)
                {
                    if (count($this->frames) < $this->max_frames - 1)
                    {
                        $this->frames[] = new Frame();
                    }
                    else
                    {
                        $this->frames[] = new EndFrame();
                    }
                }
                else
                {
                    $this->is_finished = true;
                }
            }
        }
    }

    /**
     * Gets a specific frame.
     *
     * @return object
     */
    public function getFrame($index = 0)
    {
        if (array_key_exists($index, $this->frames))
        {
            return $this->frames[$index];
        }
    }

    /**
     * Returns all frames from this game.
     *
     * @return array
     */
    public function getFrames()
    {
        return $this->frames;
    }

    /**
     * Checks if the game is finished.
     *
     * @return bool
     */
    public function isFinished()
    {
        return $this->is_finished;
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
        echo "Welcome to the PHP Bowling Kata!" . PHP_EOL .
            "You'll be prompted for the score of each of your rolls." . PHP_EOL .
            "Type \"quit\" to exit" . PHP_EOL;

        while(! $this->is_finished)
        {
            echo "Enter your score for Frame #" . count($this->getFrames()) . " roll #" . $this->getFrame()->getRoll() . ": " . PHP_EOL;

            $handle = fopen ("php://stdin","r");

            $this_roll = fgets($handle);

            $this_roll = trim($this_roll);

            if(is_numeric($this_roll))
            {
                $this->roll($this_roll);
            }
            elseif($this_roll == 'quit')
            {
                echo "Thanks for playing" . PHP_EOL;
                exit;
            }

        }

        echo "Your score without bonuses is " . $this->score();

    }

    /**
     * Returns the current frame.
     *
     * @return object
     */
    protected function getCurrentFrame()
    {
        return $this->frames[count($this->frames) - 1];
    }
}
