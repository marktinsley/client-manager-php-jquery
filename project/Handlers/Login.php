<?php

namespace Project\Handlers;

use Project\Response\Redirect;
use Project\Response\View;
use Project\Routing\Request;
use Project\Session;
use Project\User\Auth;

class Login extends BaseHandler
{
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
        if ($this->auth->isLoggedIn()) {
            return new Redirect('/clients');
        }

        return ($this->request->method() === 'GET')
            ? $this->loginForm()
            : $this->authenticate();
    }

    /**
     * @return View
     */
    private function loginForm()
    {
        return (new View('login'))
            ->with($this->session->getFlashedMessage() + [
                    'isLoggedIn' => $this->auth->isLoggedIn()
                ]);
    }

    /**
     * Authenticate a user.
     *
     * @return Redirect
     */
    private function authenticate()
    {
        $result = (new Auth())->attempt(
            $this->request->param('username'),
            $this->request->param('password')
        );

        if ($result) {
            $this->session->flashMessage('Successfully logged in.', 'success');
            return new Redirect('/clients');
        }

        $this->session->flashMessage('Did not recognize credentials.', 'danger');
        return new Redirect('/login');
    }
}
