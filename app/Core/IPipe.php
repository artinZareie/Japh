<?php

interface IPipe
{
    /**
     * Run Pipe
     *
     * @param mixed $data
     * @return void
     */
    public function run($data);
}