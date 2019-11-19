<?php

namespace App\Firelines;
use App\Core\IRenderable;

/**
 * HttpRenderable class
 */
class HttpRenderable implements IRenderable
{
    /**
     * Headers array
     *
     * @var array
     */
    public $headers = [];

    /**
     * Sessions Overwriting
     * 
     * If true, overwrites $_SESSION with $sessions.
     *
     * @var boolean
     */
    public $session_overwriting = false;

    /**
     * Sessions array
     *
     * @var array
     */
    public $sessions = [];

    /**
     * Body of http response
     *
     * @var string
     */
    private $body = "";

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->sessions = $_SESSION;
    }

    /**
     * Status code
     * 
     * A code that show status of response.
     *
     * @var integer
     */
    public $status_code = 200;

    public function setStatusCode($code = 200): void
    {
        $this->status_code = $code; 
    }

    /**
     * Set Body function
     * 
     * A function to set content of body of http response.
     *
     * @param string $content
     * @return void
     */
    public function setBody(string $content): void
    {
        $this->body = $content;
    }

    /**
     * Get Body function
     * 
     * A function to get content of body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;    
    }
    
    /**
     * Add Body function
     * 
     * Used for merge a string with body.
     *
     * @param string $content
     * @return void
     */
    public function addBody(string $content): void
    {
        $this->body .= $content;    
    }

    /**
     * ClearBody function
     * 
     * Resets Body.
     *
     * @return void
     */
    public function clearBody(): void
    {
        $this->body = '';    
    }

    /**
     * Add Header function
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function addHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    /**
     * Remove Header function
     *
     * @param string $name
     * @return void
     */
    public function removeHeader(string $name): void
    {
        unset($this->headers[$name]);
    }

    /**
     * Clear header function
     *
     * @return void
     */
    public function clearHeaders(): void
    {
        $this->headers = [];
    }

    /**
     * Overwrite sessions
     * 
     * Will change $_SESSION if is true and you won't be able to change sessions manually.
     *
     * @param boolean $value
     * @return void
     */
    public function overwriteSessions(bool $value = true)
    {
        $this->session_overwriting = $value;
    }

    /**
     * Implemented from IRenderable
     *
     * @return string
     */
    public function __toString(): string
    {
        return '';
    }
}
