<?php

class Frame
{
    protected $score;
    protected $roll_count;
    protected $max_rolls;
    protected $is_strike;
    protected $is_spare;

    public function __construct()
    {
        $this->score      = 0;
        $this->roll_count = 0;
        $this->max_rolls  = 2;
        $this->is_strike  = false;
        $this->is_spare   = false;
    }

    public function roll($pins = 0)
    {
        if ($this->roll_count < $this->max_rolls)
        {
            ++$this->roll_count;

            $this->score();

            return true;
        }
        else
        {
            return false;
        }
    }

    protected function score()
    {
        $this->score += $pins;

        if ($this->score === 10)
        {
            if ($this->roll_count === 1)
            {
                $this->is_strike = true;
                $this->roll_count = $this->max_rolls;
            }
            else if ($this->roll_count === 2)
            {
                $this->is_spare = true;
            }
        }
    }
}
