<?php

namespace App\Core;

use Exception;

/**
 * Interrupt Exception
 * 
 * This exception is a little like `int 0x80 && hlt` in assembly :/
 * it tells the kernel: 'hey, stop application and render my renderable'
 * then the kernel will stop execution, and will render your renderable!
 * 
 * @example https://github.com/artinZareie/Japh/wiki/Interrupt-Exception complete documention
 */
class InterruptException extends Exception
{
    /**
     * renderable
     *
     * @var IRenderable
     */
    private $renderable;

    /**
     * construct
     *
     * @param string $message
     * @param IRenderable $renderable
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct($message, IRenderable $renderable, $code = 0, Exception $previous = null) {
        $this->renderable = $renderable;
        parent::__construct($message, $code, $previous);
    }

    public function getRenderable(): IRenderable {
        return $this->renderable;
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
