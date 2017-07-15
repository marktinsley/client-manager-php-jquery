<?php

namespace Project;

class View
{
    private $viewData;
    private $path;

    /**
     * Constructor.
     *
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->viewData = [];
    }

    /**
     * Provide data to the view.
     *
     * @param $viewData
     *
     * @return $this
     */
    public function with($viewData)
    {
        $this->viewData = $viewData;

        return $this;
    }

    /**
     * Render the view.
     *
     * @return string
     */
    public function render()
    {
        ob_start();

        extract($this->viewData);
        require $this->resolvePath();

        return ob_get_clean();
    }

    /**
     * Resolve the path to the view.
     *
     * @return string
     */
    public function resolvePath()
    {
        return __DIR__ . '/../views/' . str_replace('.', '/', $this->path) . '.php';
    }
}
