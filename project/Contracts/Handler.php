<?php

namespace Project\Contracts;

interface Handler
{
    /**
     * Handle the route request.
     *
     * @return string
     */
    public function handle();
}