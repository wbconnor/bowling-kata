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
}
