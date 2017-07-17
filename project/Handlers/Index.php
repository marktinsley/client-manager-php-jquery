<?php

namespace Project\Handlers;

use Project\Response\Redirect;
use Project\Routing\Request;
use Project\User\Auth;

class Index extends BaseHandler
{
    protected $auth;

    /**
     * Login constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->auth = new Auth();
    }

    /**
     * Handle the route request.
     *
     * @return string
     */
    public function handle()
    {
        if ($this->auth->isLoggedIn()) {
            return new Redirect('/clients');
        }

        return new Redirect('/login');
    }
}