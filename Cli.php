<?php

class Cli
{
    protected $input;

    /**
     * Constructor initializes all properties.
     *
     * @return void
     */
    public function __construct()
    {
        $this->input = [];
    }

    /**
     * Returns clean input from the command line.
     *
     * @return string
     */
    public function input()
    {
        return trim($this->inputRaw());
    }

    /**
     * Returns raw input from the command line.
     *
     * @return string
     */
    public function inputRaw()
    {
        $input         = fgets(STDIN);
        $this->input[] = $input;

        return $input;
    }

    /**
     * Outputs a message to the command line.
     *
     * @param $output  string
     * @param $newline boolean
     * @return void
     */
    public function output($output = '', $newline = true)
    {
        if ($newline)
        {
            $output = PHP_EOL . $output;
        }

        fwrite(STDOUT, $output);
    }

    /**
     * Outputs an error to the command line.
     *
     * @param $error   string
     * @param $newline boolean
     * @return void
     */
    public function error($error = '', $newline = true)
    {
        if ($newline)
        {
            $error = PHP_EOL . $error;
        }

        fwrite(STDERR, $error);
    }
}
