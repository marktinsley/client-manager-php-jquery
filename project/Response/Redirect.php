<?php

namespace Project\Response;

use Project\Contracts\Response;

class Redirect implements Response
{
    /**
     * @var
     */
    private $redirectTo;

    /**
     * Constructor.
     *
     * @param $redirectTo
     */
    public function __construct($redirectTo)
    {
        $this->redirectTo = $redirectTo;
    }

    /**
     * Where to redirect to.
     * 
     * @return string
     */
    public function to()
    {
        return $this->redirectTo;
    }
}
