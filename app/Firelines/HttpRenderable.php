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
     * @return HttpRenderable
     */
    public $status_code = 200;

    public function setStatusCode($code = 200): HttpRenderable
    {
        $this->status_code = $code;
        return $this;
    }

    /**
     * Set Body function
     * 
     * A function to set content of body of http response.
     *
     * @param string $content
     * @return HttpRenderable
     */
    public function setBody(string $content): HttpRenderable
    {
        $this->body = $content;
        return $this;
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
     * @return HttpRenderable
     */
    public function addBody(string $content): HttpRenderable
    {
        $this->body .= $content;
        return $this;
    }

    /**
     * ClearBody function
     * 
     * Resets Body.
     *
     * @return HttpRenderable
     */
    public function clearBody(): HttpRenderable
    {
        $this->body = '';
        return $this;  
    }

    /**
     * Add Header function
     *
     * @param string $name
     * @param string $value
     * @return HttpRenderable
     */
    public function addHeader(string $name, string $value): HttpRenderable
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Remove Header function
     *
     * @param string $name
     * @return HttpRenderable
     */
    public function removeHeader(string $name): HttpRenderable
    {
        unset($this->headers[$name]);
        return $this;
    }

    /**
     * Clear header function
     *
     * @return HttpRenderable
     */
    public function clearHeaders(): HttpRenderable
    {
        $this->headers = [];
        return $this;
    }

    /**
     * Overwrite sessions
     * 
     * Will change $_SESSION if is true and you won't be able to change sessions manually.
     *
     * @param boolean $value
     * @return HttpRenderable
     */
    public function overwriteSessions(bool $value = true): HttpRenderable
    {
        $this->session_overwriting = $value;
        return $this;
    }

    /**
     * Json function
     * 
     * Gets an array and status code. Converts array to json and automaticlly sets headers and status code.
     *
     * @param array $data
     * @param integer $status_code
     * @return HttpRenderable
     */
    public function json(array $data, int $status_code = 200): HttpRenderable
    {
        $this->setBody(\json_encode($data))->setStatusCode($status_code)->addHeader('Content-Type', 'application/json');
        return $this;
    }

    /**
     * Redirect function
     *
     * @param string $to
     * @param int $code
     * @return HttpRenderable
     */
    public function redirect(string $to, int $code = 301): HttpRenderable
    {
        $this->addHeader("Location", $to);
        $this->setStatusCode($code);
        return $this;
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
