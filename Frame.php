<?php

class Frame
{
    protected $score;
    protected $score_bonus;
    protected $rolls;
    protected $max_rolls;
    protected $is_finished;

    /**
     * Constructor initializes all properties.
     *
     * @return void
     */
    public function __construct()
    {
        $this->score       = 0;
        $this->score_bonus = 0;
        $this->rolls       = [];
        $this->max_rolls   = 2;
        $this->is_finished = false;
    }

    /**
     * Attempts to complete a roll within the frame.
     *
     * @return void
     */
    public function roll($pins = 0)
    {
        if (count($this->rolls) < $this->max_rolls && !$this->is_finished)
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
     * Returns the current score of this frame.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
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

        if ($this->score === 10 || count($this->rolls) === $this->max_rolls)
        {
            $this->is_finished = true;
        }
    }
}
