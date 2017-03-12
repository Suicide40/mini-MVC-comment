<?php

namespace TestProject\Components;


interface IViewRender
{
    /**
     * Render the view
     *
     * @param string $viewName
     * @param array $params
     * @return string
     */
    public function render($viewName, $params = []);
}