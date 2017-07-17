<?php

namespace Project\Routing;

use Project\Response\Failure;
use Project\Response\Redirect;
use Project\Response\View;

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
            $this->outputNotFound();
        }

        if ($response instanceof Failure) {
            $this->outputFailure($response);
        } else if ($response instanceof Redirect) {
            $this->redirect($response);
        } else if ($response instanceof View) {
            $this->outputView($response);
        }

        $this->outputJson($response);
    }

    /**
     * Build the response.
     *
     * @return mixed
     */
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

        $result = rtrim('Project\Handlers\\' . implode('\\', $pathParts), '\\');

        return $result . (class_exists($result) ? '' : '\Index');
    }

    /**
     * Redirect to another uri.
     *
     * @param $response
     */
    protected function redirect(Redirect $response)
    {
        header('Location: ' . $response->to());
        exit;
    }

    /**
     * Output a view.
     *
     * @param $response
     */
    protected function outputView(View $response)
    {
        header('Content-Type: text/html');
        echo $response->render();
        exit;
    }

    /**
     * Output response as json.
     *
     * @param $response
     */
    protected function outputJson($response)
    {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    /**
     * Output 404, not found.
     */
    protected function outputNotFound()
    {
        http_response_code(404);
        exit("Could not find page.");
    }

    /**
     * Output a failure.
     *
     * @param Failure $failure
     */
    protected function outputFailure(Failure $failure)
    {
        http_response_code($failure->getHttpCode());
        exit($failure->getMessage());
    }
}
