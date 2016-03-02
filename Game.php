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
        if (!$this->is_finished)
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
                if (count($this->frames) < $this->max_frames - 1)
                {
                    // add another normal frame
                    $this->frames[] = new Frame();
                }
                else if (count($this->frames) < $this->max_frames)
                {
                    $this->frames[] = new FinalFrame();
                }
            }

            if (count($this->frames) === $this->max_frames && $this->getCurrentFrame()->isFinished())
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
        if($this->is_finished)
        {
            $score   = 0;
            $strikes = 0;
            $spares  = 0;

            echo PHP_EOL;

            foreach ($this->frames as $index => $frame)
            {
                $score   += $frame->getScore();
                $strikes += $frame->getStrikesCount();
                $spares  += $frame->getSparesCount();

                echo "Is Strike: " . ($frame->isStrike() ? 'true' : 'false') . PHP_EOL;
                echo "Is Spare: " . ($frame->isSpare() ? 'true' : 'false') . PHP_EOL;

                echo "Score for frame #" . ($index + 1) . " is " . $frame->getScore() . PHP_EOL .
                    "Running total is " . $score . PHP_EOL . PHP_EOL;
            }
        }

        echo PHP_EOL . "Final Score = " . $score .
            PHP_EOL . "Strikes = " . $strikes .
            PHP_EOL . "Spares = " . $spares .
            PHP_EOL . PHP_EOL . "Thanks for playing!";
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

        while(!$this->is_finished)
        {
            $this->cli->output('Enter your score for Frame #');
            $this->cli->output(count($this->getFrames()), false);
            $this->cli->output(' Roll #' . ($this->getCurrentFrame()->getRollsCount() + 1) . ': ', false);

            $input = $this->cli->input();

            if ($input === 'q')
            {
                $this->cli->output('Thanks for playing!');
                $this->cli->output();

                exit();
            }

            $roll = (int) $input;

            if (is_numeric($roll))
            {
                $this->roll($roll);
            }
            else
            {
                $this->cli->output('Sorry. That\'s not a valid input.');
                $this->cli->output();
            }
        }

        $this->score();
    }

    /**
     * Returns the previous previous frame (or null).
     *
     * @return object|null
     */
    protected function getPreviousPreviousFrame()
    {
        $index = count($this->frames) - 3;
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
        $index = count($this->frames) - 2;

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
        $index = count($this->frames) - 1;

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
