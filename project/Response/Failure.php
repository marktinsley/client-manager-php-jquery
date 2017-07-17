<?php

namespace Project\Response;

use Project\Contracts\Response;

class Failure implements Response
{
    /**
     * @var
     */
    protected $code;
    /**
     * @var string
     */
    protected $message;

    /**
     * Failure constructor.
     *
     * @param int $code
     * @param string $message
     */
    public function __construct($code = 500, $message = "There was an error processing your request.")
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Gives you the HTTP response code.
     *
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->code;
    }

    /**
     * Gives you the message for the error.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
