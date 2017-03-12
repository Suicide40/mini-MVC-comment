<?php

namespace TestProject\Controllers;


class HomeController extends BaseController
{
    /**
     * Main action
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('main', []);
    }
}