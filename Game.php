<?php

require_once (__DIR__ . '/Cli.php');
require_once (__DIR__ . '/Frame.php');
require_once (__DIR__ . '/FinalFrame.php');

class Game
{
    protected $cli;
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
        $this->cli         = new Cli();
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
        if (!$this->isFinished())
        {
            $this->getCurrentFrame()->roll($pins);

            // check previous frames for bonuses
            if (!(null === $this->getPreviousFrame()) && !$this->getPreviousFrame()->isFinished())
            {
                if ($this->getPreviousFrame()->isStrike())
                {
                    // strike, add bonus
                    $this->getPreviousFrame()->roll($pins);

                    // check 2 frames back
                    if (!(null === $this->getPreviousPreviousFrame()) && !$this->getPreviousPreviousFrame()->isFinished())
                    {
                        if ($this->getPreviousPreviousFrame()->isStrike())
                        {
                            // previous previous frame was a strike, add bonus
                            $this->getPreviousPreviousFrame()->roll($pins);
                        }
                    }
                }
                else if ($this->getPreviousFrame()->isSpare())
                {
                    // spare, add bonus
                    $this->getPreviousFrame()->roll($pins);
                }
            }

            // current frame is finished
            if ($this->getCurrentFrame()->isStrike() || $this->getCurrentFrame()->isSpare() || $this->getCurrentFrame()->isFinished())
            {
                if ($this->getFramesCount() < $this->max_frames - 1)
                {
                    // add another normal frame
                    $this->frames[] = new Frame();
                }
                else if ($this->getFramesCount() < $this->max_frames)
                {
                    $this->frames[] = new FinalFrame();
                }
            }

            if ($this->getFramesCount() === $this->max_frames && $this->getCurrentFrame()->isFinished())
            {
                $this->is_finished = true;
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
     * Returns total number of frames in play.
     *
     */
    public function getFramesCount()
    {
        return count($this->frames);
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
        if($this->isFinished())
        {
            $score   = 0;
            $strikes = 0;
            $spares  = 0;

            $this->cli->output('/---- Scores ----/');
            $this->cli->output();

            foreach ($this->frames as $index => $frame)
            {
                $score   += $frame->getScore();
                $strikes += $frame->getStrikesCount();
                $spares  += $frame->getSparesCount();

                $this->cli->output('Frame #' . ($index + 1));
                $this->cli->output('Score: ' . ($frame->getScore()));
                $this->cli->output('Running Total: ' . ($score));
                $this->cli->output();
            }

            $this->cli->output('Final Score: ' . ($score));
            $this->cli->output('Total Strikes: ' . ($strikes));
            $this->cli->output('Total Spares: ' . ($spares));
            $this->cli->output();

            $this->cli->output('Thanks for playing!');
            $this->cli->output();
        }
    }

    /**
     * Runs the game.
     *
     * @return void
     */
    public function run()
    {
        $this->cli->output('Welcome to the PHP Bowling Kata!');
        $this->cli->output('You will be prompted for each of your rolls.');
        $this->cli->output('Enter "q" to exit');
        $this->cli->output();

        $this->cli->output('/---- Rolls ----/');
        $this->cli->output();

        while(!$this->isFinished())
        {
            $roll_number  = $this->getCurrentFrame()->getRollsCount() + 1;

            // only output frame number on the first roll
            if ($roll_number === 1)
            {
                $this->cli->output('Frame #' . ($this->getFramesCount()));
                $this->cli->output();
            }

            $this->cli->output('Enter Roll #' . ($roll_number) . ': ', false);

            $input = $this->cli->input();

            if ($input === 'q')
            {
                $this->cli->output('Thanks for playing!');
                $this->cli->output();

                exit();
            }

            if (is_numeric($input))
            {
                $this->roll($input);
            }
            else
            {
                $this->cli->error('Sorry. That\'s not a valid input.');
                $this->cli->error();
            }
        }

        $this->score();
        exit();
    }

    /**
     * Returns the previous previous frame (or null).
     *
     * @return object|null
     */
    protected function getPreviousPreviousFrame()
    {
        $index = $this->getFramesCount() - 3;
        if (array_key_exists($index, $this->frames))
        {
            return $this->frames[$index];
        }
        else
        {
            return null;
        }
    }

    /**
     * Returns the previous frame (or null).
     *
     * @return object|null
     */
    protected function getPreviousFrame()
    {
        $index = $this->getFramesCount() - 2;

        if (array_key_exists($index, $this->frames))
        {
            return $this->frames[$index];
        }
        else
        {
            return null;
        }
    }

    /**
     * Returns the current frame.
     *
     * @return object
     */
    protected function getCurrentFrame()
    {
        $index = $this->getFramesCount() - 1;

        return $this->frames[$index];
    }

    /**
     * Returns the final frame (or null).
     *
     * @return object|null
     */
    protected function getFinalFrame()
    {
        $index = $this->max_frames - 1;

        if (array_key_exists($index, $this->frames))
        {
            return $this->frames[$index];
        }
        else
        {
            return null;
        }
    }
}
