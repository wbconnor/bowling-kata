<?php

class Frame
{
    protected $score;
    protected $rolls;
    protected $max_rolls;
    protected $is_strike;
    protected $is_spare;
    protected $is_finished;

    /**
     * Constructor initializes all properties.
     *
     * @return void
     */
    public function __construct()
    {
        $this->score       = 0;
        $this->rolls       = [];
        $this->max_rolls   = 2;
        $this->is_strike   = false;
        $this->is_spare    = false;
        $this->is_finished = false;
    }

    /**
     * Attempts to complete a roll within the frame.
     *
     * @return void
     */
    public function roll($pins = 0)
    {
        if (!$this->is_finished)
        {
            $this->score($pins);
        }
    }

    /**
     * Returns a specific roll record.
     *
     * @return array
     */
    public function getRoll($index = 0)
    {
        if (array_key_exists($index, $this->rolls))
        {
            return $this->rolls[$index];
        }
    }

    /**
     * Returns all previous rolls.
     *
     * @return array
     */
    public function getRolls()
    {
        return $this->rolls;
    }

    /**
     * Returns total number of rolls already taken.
     *
     * @return int
     */
    public function getRollsCount()
    {
        return count($this->rolls);
    }

    /**
     * Returns the current score of this frame.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Returns the total number of strikes.
     *
     * @return int
     */
    public function getStrikesCount()
    {
        $strikes = 0;

        if ($this->isStrike())
        {
            ++$strikes;
        }

        return $strikes;
    }

    /**
     * Returns the total number of spares.
     *
     * @return int
     */
    public function getSparesCount()
    {
        $spares = 0;

        if ($this->isSpare())
        {
            ++$spares;
        }

        return $spares;
    }

    /**
     * Returns a boolean declaring whether or not the frame is a strike.
     *
     * @return bool
     */
    public function isStrike()
    {
        return $this->is_strike;
    }

    /**
     * Returns a boolean declaring whether or not the frame is a spare.
     *
     * @return bool
     */
    public function isSpare()
    {
        return $this->is_spare;
    }

    /**
     * Returns a true if this frame is finished.
     *
     * @return bool
     */
    public function isFinished()
    {
        return $this->is_finished;
    }

    /**
     * Sets the score for this frame.
     *
     * @return void
     */
    protected function score($pins = 0)
    {
        $this->rolls[] = $pins;
        $this->score   += $pins;

        if ($this->getRollsCount() === 1 && $this->score === 10)
        {
            // strike
            $this->is_strike = true;
            $this->max_rolls += 1; // since a strike means there was only one roll, we only need to add 1 to the max rolls to allow 2 bonus rolls.
        }
        else if ($this->getRollsCount() === 2 && $this->score === 10 && !$this->isStrike())
        {
            // spare
            $this->is_spare  = true;
            $this->max_rolls += 1; // since a spare means there were two rolls, we only need to add 1 to the max rolls to allow 1 bonus roll.
        }
        else if ($this->getRollsCount() === 2 && !$this->isStrike())
        {
            // nothing special
        }
        else
        {
            // first turn, no strike
        }

        if ($this->getRollsCount() === $this->max_rolls)
        {
            $this->is_finished = true;
        }
    }
}
