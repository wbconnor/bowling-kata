<?php

class EndFrame extends Frame
{
    protected $allow_bonus_roll;

    public function __construct()
    {
        parent::__construct();

        $this->max_rolls        = 3;
        $this->allow_bonus_roll = false;
    }

    protected function score($pins = 0)
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
