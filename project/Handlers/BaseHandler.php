<?php

namespace Project\Handlers;

use Project\Contracts\Handler;
use Project\Routing\Request;

abstract class BaseHandler implements Handler
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
