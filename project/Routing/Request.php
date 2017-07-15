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
     * @param array $params
     */
    public function __construct(string $uri, array $params)
    {
        $this->uri = $uri;
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
}
