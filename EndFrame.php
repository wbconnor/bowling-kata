<?php

require_once (__DIR__ . '/Frame.php');

class EndFrame extends Frame
{
    /**
     * Returns the total number of strikes.
     *
     * @return int
     */
    public function getStrikesCount()
    {
        $strikes      = 0;
        $value_counts = array_count_values($this->getRolls());

        if (array_key_exists(10, $value_counts))
        {
            $strikes += ($value_counts[10]);
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
        else if ($this->isStrike() && ($this->getRoll(1) + $this->getRoll(2)) === 10)
        {
            ++$spares;
        }

        return $spares;
    }
}
