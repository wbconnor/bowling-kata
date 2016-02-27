<?php

class Frame
{
    protected $score;
    protected $score_bonus;
    protected $rolls;
    protected $max_rolls;
    protected $is_finished;

    public function __construct()
    {
        $this->score       = 0;
        $this->score_bonus = 0;
        $this->rolls       = [];
        $this->max_rolls   = 2;
        $this->is_finished = false;
    }

    public function roll($pins = 0)
    {
        if (count($this->rolls) < $this->max_rolls && !$this->is_finished)
        {
            $this->score($pins);
        }
    }

    public function getRoll($index = 0)
    {
        if (array_key_exists($index, $this->rolls))
        {
            return $this->rolls[$index];
        }
    }

    public function getRolls()
    {
        return $this->rolls;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function isFinished()
    {
        return $this->is_finished;
    }

    protected function score($pins = 0)
    {
        $this->rolls[] = $pins;
        $this->score   += $pins;

        if ($this->score === 10)
        {
            $this->is_finished = true;
        }
    }
}
