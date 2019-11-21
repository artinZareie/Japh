<?php

namespace App\Core;

use Closure;

class RecurcivePipeline
{
    /**
     * Pipes of pipeline
     *
     * @var array
     */
    protected $pipes = [];

    /**
     * Method of callable class
     *
     * @var string
     */
    protected $method = 'handle';

    /**
     * Passable
     *
     * @var any
     */
    protected $passable;

    /**
     * Constructor function
     *
     * @param array $pipes
     * @param string $method
     */
    public function __construct(array $pipes = [], string $method = 'handle')
    {
        $this->pipes = $pipes;
        $this->method = $method;
    }

    /**
     * via function
     *
     * @param string $method
     * @return RecurcivePipeline
     */
    public function via(string $method): RecurcivePipeline
    {
        $this->method = $method;
        return $this;    
    }

    /**
     * Send function
     * 
     * Sets passable value.
     *
     * @param any $passable
     * @return RecurcivePipeline
     */
    public function send($passable): RecurcivePipeline
    {
        $this->passable = $passable;
        return $this;
    }

    /**
     * Set the array of pipes.
     *
     * @param  array|mixed  $pipes
     * @return RecurcivePipeline
     */
    public function through($pipes): RecurcivePipeline
    {
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();

        return $this;
    }

    /**
     * Get the final piece of the Closure onion.
     *
     * @param  \Closure  $destination
     * @return \Closure
     */
    protected function prepareDestination(Closure $destination)
    {
        return function ($passable) use ($destination) {
            return $destination($passable);
        };
    }

    /**
     * Carry function
     * 
     * Returns array_reduce second parameter
     *
     * @return Closure
     */
    protected function carry(): Closure
    {
        return function($stack, $pipe) {
            return function($passable) use ($stack, $pipe) {
                if (\is_callable($pipe)) {
                    return $pipe($passable, $stack);
                }
                elseif (!is_object($pipe)) {
                    [$name, $parameters] = $this->parsePipeString($pipe);
                    $pipe = inject($name);
                    $parameters = array_merge([$passable, $stack], $parameters);
                }
                else {
                    $parameters = [$passable, $stack];
                }
                return method_exists($pipe, $this->method) ? $pipe->{$this->method}(...$parameters) : $pipe(...$parameters);
            };
        };
    }

    /**
     * Parse Pipe String
     *
     * @param string $pipe
     * @return array
     */
    protected function parsePipeString(string $pipe): array
    {
        [$name, $parameters] = array_pad(explode('.', $pipe, 2), 2, []);

        if (is_string($parameters)) {
            $parameters = explode(',', $parameters);
        }

        return [$name, $parameters];
    }

    /**
     * Then function
     * 
     * Runs the pipeline with a final callback
     *
     * @param Closure $destination
     * @return void
     */
    public function then(Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->pipes),
            $this->carry(),
            $this->prepareDestination($destination)
        );
        return $pipeline($this->passable);
    }
    
    /**
     * Run the pipeline and return the result.
     *
     * @return mixed
     */
    public function thenReturn()
    {
        return $this->then(function ($passable) {
            return $passable;
        });
    }
}
