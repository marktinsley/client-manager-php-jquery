<?php

namespace Project\Handlers\Clients;

use Project\Databases\Connection;
use Project\Handlers\BaseHandler;
use Project\Response\Redirect;
use Project\Response\View;
use Project\Routing\Request;
use Project\Session;
use Project\User\Auth;

class Index extends BaseHandler
{
    protected $db;
    protected $session;
    protected $auth;

    /**
     * Login constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->db = Connection::getInstance();
        $this->session = Session::getInstance();
        $this->auth = new Auth();
    }

    /**
     * Handle the route request.
     *
     * @return string
     */
    public function handle()
    {
        if ( ! $this->auth->isLoggedIn()) {
            return new Redirect('/login');
        }

        return (new View('clients.index'))->with(
            $this->session->getFlashedMessage() + [
                'isLoggedIn' => $this->auth->isLoggedIn(),
            ]);
    }
}