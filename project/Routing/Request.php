<?php

namespace Project\Routing;

class Request
{
    /**
     * The URI for this request.
     *
     * @var string
     */
    private $uri;

    private $method;

    /**
     * The params for this request.
     *
     * @var array
     */
    private $params;

    /**
     * Constructor.
     *
     * @param string $uri
     * @param string $method
     * @param array $params
     */
    public function __construct($uri, $method, array $params)
    {
        $this->uri = $uri;
        $this->method = strtoupper($method);
        $this->params = $params;
    }

    /**
     * The URI for this request.
     *
     * @return mixed
     */
    public function path()
    {
        return parse_url($this->uri, PHP_URL_PATH);
    }

    /**
     * Get the path parts.
     *
     * @return array
     */
    public function pathParts()
    {
        return explode('/', trim($this->path(), '/'));
    }

    /**
     * The params for this request.
     *
     * @return array
     */
    public function params()
    {
        return $this->params;
    }

    /**
     * Gives you the value of a param and null if param wasn't provided.
     *
     * @param $name
     *
     * @return mixed|null
     */
    public function param($name)
    {
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }

    /**
     * The request method.
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }
}
