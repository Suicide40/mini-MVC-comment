<?php

namespace TestProject\Components;


class ViewRender implements IViewRender
{
    /**
     * Path for MVC views
     */
    const VIEWS_PATH = 'src/Views';

    const VIEWS_EXTENSION = 'php';

    /**
     * @inheritdoc
     */
    public function render($viewName, $params = [])
    {
        //careful...in view we can get this variable
        $pathForView = $this->getPathForView($viewName);

        extract($params);
        ob_start();
        require $pathForView;

        return ob_get_clean();
    }

    /**
     * Get global path for view file
     *
     * @param $viewName
     * @return string
     */
    private function getPathForView($viewName)
    {
        return BASE_PATH
            . DIRECTORY_SEPARATOR
            . self::VIEWS_PATH
            . DIRECTORY_SEPARATOR
            . $viewName
            . '.'
            . self::VIEWS_EXTENSION;
    }

}