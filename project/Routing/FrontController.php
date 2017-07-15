<?php

namespace Project\Routing;

use Project\View;

class FrontController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * FrontController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Output the response for this request.
     */
    public function outputResponse()
    {
        try {
            $response = $this->buildResponse();
        } catch (CouldNotResolveRouteException $e) {
            header('HTTP/1.0 404 Not Found');
            die("Could not find page.");
        }

        if ($response instanceof View) {
            header('Content-Type: application/json');
            echo $response->render();
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function buildResponse()
    {
        $handler = $this->resolveHandler();

        if ( ! class_exists($handler)) {
            throw new CouldNotResolveRouteException();
        }

        return (new $handler($this->request))->handle();
    }

    /**
     * Resolve the handler that should handle this request.
     *
     * @return string
     */
    public function resolveHandler()
    {
        $toStudlyCase = function ($value) {
            $value = ucwords(str_replace(['-', '_'], ' ', $value));

            return str_replace(' ', '', $value);
        };

        $pathParts = array_map($toStudlyCase, $this->request->pathParts());

        $result = 'Project\Handlers\\' . implode('\\', $pathParts);

        return $result . (class_exists($result) ? '' : '\Index');
    }
}
