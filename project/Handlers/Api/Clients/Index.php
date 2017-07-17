<?php

namespace Project\Handlers\Api\Clients;

use Project\Handlers\BaseHandler;
use Project\Response\View;

class Index extends BaseHandler
{
    /**
     * Handle the route request.
     *
     * @return string
     */
    public function handle()
    {
        return (new View('clients.index'))
            ->with(['list' => 'testestsetse']);
    }
}