<?php

namespace App\Core;

/**
 * Pipeline
 * 
 * Provides a staged pipeline wich output of 
 * every stage is input of next stage and the
 * output of class is the output of last stage.
 */
class Pipeline {
    /**
     * Pipes
     *
     * @var object[]
     */
    private $pipes = [];

    public function __construct(array $pipes)
    {
        $this->pipes = $pipes;
    }

    /**
     * Add Pipe
     *
     * Adds a pipe to pipeline in the end of pipeline.
     * 
     * @param IPipe $func
     * @return void
     */
    public function pipe(IPipe $func)
    {
        array_push($this->pipes, $func);
    }

    /**
     * Run Pipeline
     *
     * @param object $context
     * @return void
     */
    public function run($context)
    {
        foreach ($this->pipes as $pipe) {
            $context = $pipe->run($context);
        }
        return $context;
    }

}