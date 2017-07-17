<?php

require __DIR__ . '/vendor/autoload.php';

(new \Project\Routing\FrontController(
    new \Project\Routing\Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_REQUEST)
))->outputResponse();
