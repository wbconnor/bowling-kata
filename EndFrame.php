<?php

require_once (__DIR__ . '/Frame.php');

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
        $this->rolls[] = $pins;
        $this->score   += $pins;

        if (count($this->rolls) === 2 && $this->score < 10)
        {
            $this->is_finished = true;
        }
        else if (count($this->rolls) === $this->max_rolls)
        {
            $this->is_finished = true;
        }
    }
}
