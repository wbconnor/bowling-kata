<?php

class Cli
{
    public function __construct()
    {
        // initialize
    }

    public function input()
    {
        return trim($this->inputRaw());
    }

    public function inputRaw()
    {
        return fgets(STDIN);
    }

    public function output($output = '', $newline = true)
    {
        if ($newline)
        {
            $output = PHP_EOL . $output;
        }

        fwrite(STDOUT, $output);
    }

    public function error($error = '', $newline = true)
    {
        if ($newline)
        {
            $error = PHP_EOL . $error;
        }

        fwrite(STDERR, $error);
    }
}
